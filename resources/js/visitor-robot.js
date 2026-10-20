/**
 * Visitor Notes — 3D Robot (Three.js + GLTFLoader)
 * Enhanced with: neon aura, floating particles, energy rings,
 * hologram scan lines, eye glow pulse, reaction sparks.
 */
import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

export function initVisitorRobot() {
    const container = document.querySelector('[data-vn-canvas]');
    if (!container || container.dataset.vnReady) return;
    container.dataset.vnReady = '1';

    const section = document.getElementById('visitor-notes');
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const canHover = window.matchMedia('(hover: hover)').matches;
    const isMobile = window.matchMedia('(max-width: 767px)').matches;

    // ─────────────────────────────────────────
    // Renderer
    // ─────────────────────────────────────────
    let renderer;
    try {
        // Antialias dimatikan di mobile (hemat GPU besar); dpr tinggi sudah
        // menutupi perbedaan visual.
        renderer = new THREE.WebGLRenderer({ antialias: !isMobile, alpha: true, powerPreference: 'high-performance' });
    } catch (e) {
        console.warn('[visitor-robot] WebGL tidak tersedia:', e);
        return;
    }
    const MAX_DPR = isMobile ? 1.5 : 2;
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, MAX_DPR));
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.2;
    container.appendChild(renderer.domElement);

    const scene = new THREE.Scene();
    const aspect = Math.max(container.clientWidth / container.clientHeight, 0.001);
    const camera = new THREE.PerspectiveCamera(40, aspect, 0.1, 40);
    camera.position.set(0, 0.85, 2.9);
    camera.lookAt(0, 0.7, 0);

    // ─────────────────────────────────────────
    // Lighting — lebih dramatis
    // ─────────────────────────────────────────
    scene.add(new THREE.HemisphereLight(0xffffff, 0x141a30, 0.8));

    const key = new THREE.DirectionalLight(0xffffff, 1.4);
    key.position.set(1.4, 2.0, 1.8);
    scene.add(key);

    const cyanRim = new THREE.DirectionalLight(0x3d8fb0, 1.1);
    cyanRim.position.set(-1.7, 0.9, -1.6);
    scene.add(cyanRim);

    const purpleFill = new THREE.DirectionalLight(0x676bc6, 0.9);
    purpleFill.position.set(1.0, -0.4, -1.8);
    scene.add(purpleFill);

    // Dynamic accent light yang akan berdenyut
    const accentLight = new THREE.PointLight(0x3d8fb0, 1.2, 5);
    accentLight.position.set(0, 1.0, 1.2);
    scene.add(accentLight);

    const purpleAccent = new THREE.PointLight(0x8b5cf6, 0.8, 4);
    purpleAccent.position.set(0, 0.5, -1.0);
    scene.add(purpleAccent);

    // ─────────────────────────────────────────
    // Energy Rings (hologram circles)
    // ─────────────────────────────────────────
    const rings = [];
    const ringColors = [0x3d8fb0, 0x8b5cf6, 0x06b6d4];
    for (let i = 0; i < 3; i++) {
        const geo = new THREE.TorusGeometry(0.55 + i * 0.22, 0.008, 8, isMobile ? 40 : 64);
        const mat = new THREE.MeshBasicMaterial({
            color: ringColors[i],
            transparent: true,
            opacity: 0.0,
            side: THREE.DoubleSide,
        });
        const ring = new THREE.Mesh(geo, mat);
        ring.rotation.x = Math.PI / 2 + (i * Math.PI) / 6;
        ring.rotation.y = (i * Math.PI) / 4;
        ring.position.y = 0.7;
        scene.add(ring);
        rings.push({ mesh: ring, mat, phase: i * 2.1, speed: 0.6 + i * 0.25 });
    }

    // ─────────────────────────────────────────
    // Floating Particles — efek cyber dust
    // (jumlah dikurangi, terutama di mobile)
    // ─────────────────────────────────────────
    const PARTICLE_COUNT = isMobile ? 22 : 56;
    const pPositions = new Float32Array(PARTICLE_COUNT * 3);
    const pVelocities = [];
    const pSizes = new Float32Array(PARTICLE_COUNT);
    const pColors = new Float32Array(PARTICLE_COUNT * 3);

    for (let i = 0; i < PARTICLE_COUNT; i++) {
        const angle = Math.random() * Math.PI * 2;
        const radius = 0.4 + Math.random() * 0.8;
        const height = -0.2 + Math.random() * 1.8;
        pPositions[i * 3] = Math.cos(angle) * radius;
        pPositions[i * 3 + 1] = height;
        pPositions[i * 3 + 2] = Math.sin(angle) * radius;

        // Kecepatan spiral naik
        pVelocities.push({
            vx: (Math.random() - 0.5) * 0.003,
            vy: 0.003 + Math.random() * 0.005,
            vz: (Math.random() - 0.5) * 0.003,
            life: Math.random(),
            maxLife: 0.8 + Math.random() * 1.2,
        });

        pSizes[i] = 3 + Math.random() * 6;

        // Cyan / Purple / White particles
        const c = Math.random();
        if (c < 0.4) {
            pColors[i * 3] = 0.24; pColors[i * 3 + 1] = 0.56; pColors[i * 3 + 2] = 0.69; // cyan
        } else if (c < 0.75) {
            pColors[i * 3] = 0.54; pColors[i * 3 + 1] = 0.36; pColors[i * 3 + 2] = 0.96; // purple
        } else {
            pColors[i * 3] = 0.85; pColors[i * 3 + 1] = 0.92; pColors[i * 3 + 2] = 1.0;  // white
        }
    }

    const pgeo = new THREE.BufferGeometry();
    pgeo.setAttribute('position', new THREE.BufferAttribute(pPositions, 3));
    pgeo.setAttribute('color', new THREE.BufferAttribute(pColors, 3));
    pgeo.setAttribute('size', new THREE.BufferAttribute(pSizes, 1));

    const pmat = new THREE.PointsMaterial({
        size: 0.06,
        vertexColors: true,
        transparent: true,
        opacity: 0.75,
        blending: THREE.AdditiveBlending,
        depthWrite: false,
        sizeAttenuation: true,
    });
    const particles = new THREE.Points(pgeo, pmat);
    scene.add(particles);

    // ─────────────────────────────────────────
    // Scan Line Plane (hologram effect)
    // ─────────────────────────────────────────
    if (!prefersReduced) {
        const scanGeo = new THREE.PlaneGeometry(1.4, 0.02);
        const scanMat = new THREE.MeshBasicMaterial({
            color: 0x3d8fb0,
            transparent: true,
            opacity: 0.18,
            blending: THREE.AdditiveBlending,
            depthWrite: false,
        });
        const scanLine = new THREE.Mesh(scanGeo, scanMat);
        scanLine.position.set(0, 0, 0.05);
        scene.add(scanLine);

        // Animasi scan line naik-turun
        scene.userData.scanLine = scanLine;
        scene.userData.scanMat = scanMat;
    }

    // ─────────────────────────────────────────
    // Ground Grid (neon cyber floor)
    // ─────────────────────────────────────────
    const gridHelper = new THREE.GridHelper(3.5, 12, 0x3d8fb0, 0x1e1b4b);
    gridHelper.material.opacity = 0.25;
    gridHelper.material.transparent = true;
    gridHelper.position.y = -0.05;
    scene.add(gridHelper);

    // ─────────────────────────────────────────
    // Reaction Sparks (burst saat submit)
    // ─────────────────────────────────────────
    const SPARK_COUNT = 24;
    const sparkGeo = new THREE.BufferGeometry();
    const sparkPos = new Float32Array(SPARK_COUNT * 3);
    sparkGeo.setAttribute('position', new THREE.BufferAttribute(sparkPos, 3));
    const sparkMat = new THREE.PointsMaterial({
        color: 0xffd700,
        size: 0.09,
        transparent: true,
        opacity: 0.0,
        blending: THREE.AdditiveBlending,
        depthWrite: false,
    });
    const sparks = new THREE.Points(sparkGeo, sparkMat);
    scene.add(sparks);
    const sparkVel = [];
    for (let i = 0; i < SPARK_COUNT; i++) {
        const a = (i / SPARK_COUNT) * Math.PI * 2;
        sparkVel.push({
            vx: Math.cos(a) * (0.04 + Math.random() * 0.04),
            vy: 0.05 + Math.random() * 0.08,
            vz: Math.sin(a) * (0.04 + Math.random() * 0.04),
        });
        sparkPos[i * 3] = 0; sparkPos[i * 3 + 1] = 0.9; sparkPos[i * 3 + 2] = 0;
    }
    let sparkLife = 0;
    let sparkActive = false;

    function triggerSparks() {
        sparkActive = true;
        sparkLife = 0;
        sparkMat.opacity = 0.9;
        for (let i = 0; i < SPARK_COUNT; i++) {
            sparkPos[i * 3] = 0; sparkPos[i * 3 + 1] = 0.9; sparkPos[i * 3 + 2] = 0;
        }
        sparkGeo.attributes.position.needsUpdate = true;
    }

    // ─────────────────────────────────────────
    // Model & Parts
    // ─────────────────────────────────────────
    const base = new THREE.Group();
    scene.add(base);

    let model = null;
    let parts = null;

    const loader = new GLTFLoader();
    loader.load('/models/robot/scene.gltf', (gltf) => {
        model = gltf.scene;

        const box = new THREE.Box3().setFromObject(model);
        const size = box.getSize(new THREE.Vector3());
        const scale = 1.5 / Math.max(size.y, 0.001);
        model.scale.setScalar(scale);
        model.position.set(
            -box.getCenter(new THREE.Vector3()).x * scale,
            -box.min.y * scale,
            -box.getCenter(new THREE.Vector3()).z * scale
        );

        base.add(model);
        model.updateMatrixWorld(true);

        // Face camera
        const eyes = model.getObjectByName('Head_Eyes_0');
        if (eyes) {
            eyes.geometry.computeBoundingBox();
            const c = eyes.geometry.boundingBox.getCenter(new THREE.Vector3());
            eyes.updateWorldMatrix(true, false);
            const worldC = c.clone().applyMatrix4(eyes.matrixWorld);
            const origin = new THREE.Vector3().setFromMatrixPosition(model.matrixWorld);
            const dir = worldC.sub(origin);
            if (dir.lengthSq() > 0.0001) {
                base.rotation.y = -Math.atan2(dir.x, dir.z);
            }
        }
        base.updateMatrixWorld(true);

        const g = (n) => model.getObjectByName(n);
        parts = {
            head: g('Head'),
            armsRight: g('RightArm'),
            armsLeft: g('LeftArm'),
            antenna: g('Antenna'),
            root: g('RootNode') || model,
        };
        parts.base = {
            head: parts.head ? { x: parts.head.rotation.x, y: parts.head.rotation.y, z: parts.head.rotation.z } : null,
            right: parts.armsRight ? { x: parts.armsRight.rotation.x, y: parts.armsRight.rotation.y, z: parts.armsRight.rotation.z } : null,
            left: parts.armsLeft ? { x: parts.armsLeft.rotation.x, y: parts.armsLeft.rotation.y, z: parts.armsLeft.rotation.z } : null,
            antenna: parts.antenna ? { x: parts.antenna.rotation.x, y: parts.antenna.rotation.y, z: parts.antenna.rotation.z } : null,
            root: parts.root ? { x: parts.root.rotation.x, y: parts.root.rotation.y, z: parts.root.rotation.z } : null,
        };

        // Enhance materials — tambah emissive glow pada parts tertentu
        model.traverse((o) => {
            if (o.isMesh && o.material) {
                const mats = Array.isArray(o.material) ? o.material : [o.material];
                mats.forEach((m) => {
                    if (m.isMeshStandardMaterial || m.isMeshPhysicalMaterial) {
                        // Eyes: glow cyan
                        if (o.name.toLowerCase().includes('eye') || o.name.toLowerCase().includes('lens')) {
                            m.emissive = new THREE.Color(0x00ffff);
                            m.emissiveIntensity = 1.5;
                        }
                        // Antenna tip: glow purple
                        if (o.name.toLowerCase().includes('antenna') || o.name.toLowerCase().includes('light')) {
                            m.emissive = new THREE.Color(0x8b5cf6);
                            m.emissiveIntensity = 1.2;
                        }
                    }
                });
            }
        });

        let meshCount = 0;
        model.traverse((o) => { if (o.isMesh) meshCount++; });
        container.dataset.vnModel = 'ok';
        container.dataset.vnMeshes = String(meshCount);

        if (prefersReduced) renderOnce();
        else if (isVisible) {
            start();
            if (pendingEntranceWave) {
                pendingEntranceWave = false;
                playEntrance();
            }
        }
    }, undefined, (err) => {
        console.warn('[visitor-robot] Gagal memuat model:', err);
    });

    // ─────────────────────────────────────────
    // Gestures
    // ─────────────────────────────────────────
    let gesture = null;
    let lastAutoGesture = 0;

    // Bounce kecil sesekali (hop) — tidak terus-menerus.
    let bounce = null;
    let lastBounce = performance.now() + 4000;
    const BOUNCE_MIN = 6500;
    const BOUNCE_CHANCE = (delta) => delta / 9;

    function triggerGesture(type) {
        if (!model || prefersReduced || gesture) return;
        const dur = type === 'wave' ? 1.6 : type === 'nod' ? 0.95 : 1.2;
        gesture = { type, t: 0, dur };
        lastAutoGesture = performance.now();
        if (type === 'react') triggerSparks();
    }

    function partOffsets(g, time) {
        const o = {
            head: { x: 0, y: 0, z: 0 },
            right: { x: 0, y: 0, z: 0 },
            left: { x: 0, y: 0, z: 0 },
            antenna: { x: 0, y: 0, z: 0 },
            root: { x: 0, y: 0, z: 0 },
        };
        if (g) {
            const k = Math.sin(Math.PI * g.t);
            if (g.type === 'wave') {
                o.right.z -= k * 0.6 + Math.sin(g.t * Math.PI * 6) * 0.08 * k;
                o.right.x -= k * 0.25;
                o.head.x += k * 0.08;
                o.root.x -= k * 0.05;
                o.antenna.z = Math.sin(g.t * Math.PI * 10) * 0.15 * k;
            } else if (g.type === 'nod') {
                o.head.x -= k * 0.45;
                o.antenna.x -= k * 0.3;
            } else if (g.type === 'react') {
                o.right.z -= k * 0.55;
                o.right.x -= k * 0.2;
                o.left.z += k * 0.55;
                o.left.x -= k * 0.2;
                o.head.x += k * 0.15;
            }
        } else {
            // Idle — figure-8 head pattern, arm breathing, antenna sway
            // Head: horizontal figure-8 (lissajous) for natural curious look
            o.head.z = Math.sin(time * 1.3) * 0.08 + Math.sin(time * 0.5) * 0.03;
            o.head.x = Math.sin(time * 0.9) * 0.06 + Math.cos(time * 0.6) * 0.025;
            o.head.y = Math.sin(time * 0.7) * 0.04; // subtle side-to-side

            // Arms: gentle breathing motion (slow up-down) + slight outward sway
            const breathe = Math.sin(time * 1.2) * 0.06;
            o.right.x = Math.sin(time * 2.0) * 0.22 + breathe;
            o.right.z = Math.sin(time * 1.1 + 0.4) * 0.05 + Math.sin(time * 0.6) * 0.02;
            o.right.y = Math.cos(time * 0.8) * 0.03;
            o.left.x = -Math.sin(time * 2.0) * 0.22 + breathe;
            o.left.z = Math.sin(time * 1.1 + 0.4) * 0.05 + Math.sin(time * 0.6 + Math.PI) * 0.02;
            o.left.y = -Math.cos(time * 0.8) * 0.03;

            // Antenna: lively wiggle with dual-frequency sway
            o.antenna.z = Math.sin(time * 2.4) * 0.14 + Math.sin(time * 4.2) * 0.04;
            o.antenna.x = Math.sin(time * 1.7 + 1) * 0.09 + Math.cos(time * 3.0) * 0.03;
        }
        return o;
    }

    function applyGesture(delta) {
        if (!gesture) return;
        gesture.t = Math.min(1, gesture.t + delta / gesture.dur);
        if (gesture.t >= 1) gesture = null;
    }

    // ─────────────────────────────────────────
    // Main Loop
    // ─────────────────────────────────────────
    let rafId = null;
    let lastFrame = performance.now();
    let frameElapsed = 0;
    let mouseSmooth = 0;
    let mouseTarget = 0;

    function animate() {
        rafId = requestAnimationFrame(animate);
        const now = performance.now();
        const delta = Math.min((now - lastFrame) / 1000, 0.05);
        lastFrame = now;
        frameElapsed += delta;
        const t = frameElapsed;

        // ── Apply gestures ──
        applyGesture(delta);
        const o = partOffsets(gesture, t);

        if (parts && parts.head && parts.base.head) {
            const b = parts.base.head;
            parts.head.rotation.set(b.x + o.head.x, b.y + o.head.y + mouseNormYaw(), b.z + o.head.z);
        }
        if (parts && parts.armsRight && parts.base.right) {
            const b = parts.base.right;
            parts.armsRight.rotation.set(b.x + o.right.x, b.y + o.right.y, b.z + o.right.z);
        }
        if (parts && parts.armsLeft && parts.base.left) {
            const b = parts.base.left;
            parts.armsLeft.rotation.set(b.x + o.left.x, b.y + o.left.y, b.z + o.left.z);
        }
        if (parts && parts.antenna && parts.base.antenna) {
            const b = parts.base.antenna;
            parts.antenna.rotation.set(b.x + o.antenna.x, b.y + o.antenna.y, b.z + o.antenna.z);
        }
        if (parts && parts.root && parts.base.root) {
            const b = parts.base.root;
            parts.root.rotation.set(b.x + o.root.x, b.y + o.root.y, b.z + o.root.z);
        }

        // Bob halus = floating (combined sine waves for organic feel)
        let bobY = Math.sin(t * 1.5) * 0.055 + Math.sin(t * 0.8) * 0.025;
        // Lean kiri-kanan: dual-frequency for varied motion
        let leanZ = Math.sin(t * 0.7) * 0.025 + Math.sin(t * 1.9) * 0.012;
        // Subtle X sway
        let swayX = Math.sin(t * 0.55) * 0.008;
        if (gesture && gesture.type === 'react') bobY -= Math.sin(Math.PI * gesture.t) * 0.06;

        // Bounce / lompatan kecil sesekali — dual-bounce pattern
        if (bounce) {
            bounce.t = Math.min(1, bounce.t + delta / 0.95);
            const bk = Math.sin(Math.PI * bounce.t);
            // Primary hop + smaller secondary hop
            bobY += bk * 0.08 + Math.sin(bounce.t * Math.PI * 3) * 0.02 * bk;
            leanZ += Math.sin(bounce.t * Math.PI * 2) * 0.06 * bk;
            swayX += Math.sin(bounce.t * Math.PI * 1.5) * 0.01 * bk;
            if (bounce.t >= 1) bounce = null;
        } else if (entranceDone && !gesture && now - lastBounce > BOUNCE_MIN && Math.random() < BOUNCE_CHANCE(delta)) {
            bounce = { t: 0 };
            lastBounce = now;
        }
        base.position.y = bobY;
        base.position.x = swayX;
        base.rotation.z = leanZ;

        // Mouse tracking
        if (canHover && parts && parts.head) {
            mouseSmooth += (mouseTarget - mouseSmooth) * 0.07;
        }

        // Auto wave tiap ~12s idle
        if (entranceDone && !gesture && now - lastAutoGesture > 12000) {
            triggerGesture('wave');
        }

        // ── Energy Rings ──
        rings.forEach(({ mesh, mat, phase, speed }, i) => {
            mesh.rotation.y += delta * speed;
            mesh.rotation.z += delta * speed * 0.4;
            // Pulse opacity: 0.12 – 0.45
            mat.opacity = 0.12 + 0.33 * (0.5 + 0.5 * Math.sin(t * 1.8 + phase));
            // Expand ring saat react
            if (gesture && gesture.type === 'react') {
                const k = Math.sin(Math.PI * gesture.t);
                mat.opacity = Math.min(0.8, mat.opacity + k * 0.5);
                mesh.scale.setScalar(1 + k * 0.3);
            } else {
                mesh.scale.setScalar(1);
            }
        });

        // ── Dynamic Lights pulse ──
        accentLight.intensity = 0.9 + 0.5 * Math.sin(t * 2.1);
        purpleAccent.intensity = 0.5 + 0.4 * Math.sin(t * 1.7 + Math.PI);

        // Warna light shift subtle
        const hue = (t * 0.05) % 1;
        accentLight.color.setHSL(0.55 + Math.sin(t * 0.3) * 0.05, 0.9, 0.6);
        purpleAccent.color.setHSL(0.75 + Math.sin(t * 0.4) * 0.05, 0.9, 0.6);

        // ── Floating Particles ──
        const pos = pgeo.attributes.position.array;
        for (let i = 0; i < PARTICLE_COUNT; i++) {
            const v = pVelocities[i];
            v.life += delta;
            const lifeRatio = v.life / v.maxLife;

            pos[i * 3] += v.vx + Math.sin(t * 0.8 + i) * 0.0008;
            pos[i * 3 + 1] += v.vy * (1 - lifeRatio * 0.3);
            pos[i * 3 + 2] += v.vz + Math.cos(t * 0.7 + i) * 0.0008;

            // Reset particle saat habis
            if (v.life >= v.maxLife || pos[i * 3 + 1] > 2.2) {
                const angle = Math.random() * Math.PI * 2;
                const radius = 0.3 + Math.random() * 0.7;
                pos[i * 3] = Math.cos(angle) * radius;
                pos[i * 3 + 1] = -0.1;
                pos[i * 3 + 2] = Math.sin(angle) * radius;
                v.life = 0;
                v.vy = 0.003 + Math.random() * 0.005;
            }
        }
        pgeo.attributes.position.needsUpdate = true;

        // Opacity fade-in/out per particle based on life
        pmat.opacity = 0.6 + 0.25 * Math.sin(t * 1.2);

        // ── Scan Line ──
        const sl = scene.userData.scanLine;
        const sm = scene.userData.scanMat;
        if (sl && sm) {
            // Naik dari -0.1 ke 1.8, lalu lompat kembali
            const scanProgress = (t * 0.4) % 1;
            sl.position.y = -0.1 + scanProgress * 1.9;
            sm.opacity = 0.08 + 0.1 * (1 - scanProgress);
        }

        // ── Sparks ──
        if (sparkActive) {
            sparkLife += delta;
            const sl2 = sparkGeo.attributes.position.array;
            for (let i = 0; i < SPARK_COUNT; i++) {
                sl2[i * 3] += sparkVel[i].vx;
                sl2[i * 3 + 1] += sparkVel[i].vy - sparkLife * 0.05; // gravity
                sl2[i * 3 + 2] += sparkVel[i].vz;
            }
            sparkGeo.attributes.position.needsUpdate = true;
            sparkMat.opacity = Math.max(0, 0.9 - sparkLife * 1.5);
            if (sparkLife > 0.6) {
                sparkActive = false;
                sparkMat.opacity = 0;
            }
        }

        // ── Grid subtle rotate ──
        gridHelper.rotation.y += delta * 0.05;

        renderer.render(scene, camera);
    }

    function mouseNormYaw() {
        return canHover ? mouseSmooth * 0.3 : 0;
    }

    function start() {
        if (prefersReduced || rafId !== null) return;
        lastFrame = performance.now();
        rafId = requestAnimationFrame(animate);
    }

    function stop() {
        if (rafId !== null) {
            cancelAnimationFrame(rafId);
            rafId = null;
        }
    }

    function renderOnce() {
        renderer.render(scene, camera);
    }

    if (canHover) {
        window.addEventListener('mousemove', (e) => {
            mouseTarget = (e.clientX / window.innerWidth - 0.5) * 2;
        }, { passive: true });
    }

    // ─────────────────────────────────────────
    // Resize
    // ─────────────────────────────────────────
    const resize = () => {
        const w = container.clientWidth;
        const h = container.clientHeight;
        if (!w || !h) return;
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
        renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, MAX_DPR));
        renderer.setSize(w, h);
    };
    if (typeof ResizeObserver !== 'undefined') {
        new ResizeObserver(resize).observe(container);
    } else {
        window.addEventListener('resize', resize);
    }

    // ─────────────────────────────────────────
    // Entrance
    // ─────────────────────────────────────────
    let entranceDone = false;
    let pendingEntranceWave = false;
    let entranceTimer = null;
    // Status visibilitas section — loop hanya berjalan saat terlihat.
    let isVisible = false;

    function playEntrance() {
        clearTimeout(entranceTimer);
        entranceTimer = setTimeout(() => triggerGesture('wave'), 700);
    }

    if (typeof IntersectionObserver !== 'undefined') {
        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    isVisible = true;
                    start();
                    if (!entranceDone) {
                        entranceDone = true;
                        if (model) playEntrance();
                        else pendingEntranceWave = true;
                    }
                } else {
                    isVisible = false;
                    stop();
                }
            });
        }, { threshold: 0.15 });
        io.observe(container);
    } else {
        // Fallback browser lawas: biarkan loop berjalan.
        isVisible = true;
    }

    // ─────────────────────────────────────────
    // Form hooks: nod saat ketik, react + sparks saat submit
    // ─────────────────────────────────────────
    const form = section ? section.querySelector('[data-vn-form] form') : null;
    if (form) {
        let nodCooldown = false;
        form.querySelectorAll('input, textarea').forEach((field) => {
            field.addEventListener('input', () => {
                if (nodCooldown) return;
                nodCooldown = true;
                triggerGesture('nod');
                setTimeout(() => { nodCooldown = false; }, 2600);
            }, { passive: true });
        });

        form.addEventListener('submit', (e) => {
            if (form.dataset.vnGesture || prefersReduced) return;
            e.preventDefault();
            form.dataset.vnGesture = '1';
            triggerGesture('react'); // ini juga trigger sparks
            setTimeout(() => {
                if (typeof form.requestSubmit === 'function') form.requestSubmit();
                else form.submit();
            }, 950);
        });
    }

    // Catatan: loop TIDAK dimulai di sini — sepenuhnya dikendalikan
    // IntersectionObserver agar tidak memakan GPU/CPU saat off-screen.

    // Debug
    container.__vnDebug = {
        trigger: (t) => triggerGesture(t),
        sparks: () => triggerSparks(),
        state: () => ({
            model: container.dataset.vnModel || 'pending',
            gesture: gesture ? gesture.type : null,
            raf: rafId !== null,
            visible: isVisible,
        }),
    };
}
