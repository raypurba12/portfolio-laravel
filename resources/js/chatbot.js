export function chatbot(i18n = {}) {
    // Fallback ID agar tetap berfungsi jika string terjemahan tidak diteruskan.
    const t = {
        greeting: "Halo! 👋 Saya AI Assistant portofolio ini.\nTanyakan apa saja: skills, projects, cara kontak, atau info lainnya!",
        how_are_you: 'Kabarku baik! Lagi siap bantu-bantu di sini. 😊\nAda yang bisa saya bantu tentang portofolio?',
        who_are_you: 'Aku AI Assistant portofolio ini! 🤖\nTugasku bantu jelasin tentang projects, skills, atau apapun yang kamu penasaran.',
        where_from: 'Aku tinggal di web ini aja! 😄\nTapi yang punya portofolio ini dari Indonesia — Full Stack Developer.\nAda yang mau ditanya?',
        what_doing: 'Lagi nunggu pertanyaan dari kamu! 🫡\nAda yang pengen ditanya tentang portofolio ini?',
        thanks: 'Sama-sama! 😊\nJangan ragu untuk tanya-tanya lagi ya!',
        praise: 'Makasih! 🙌 Senang denger kalau kamu suka!\nAda lagi yang mau ditanya?',
        dont_know: 'Santai aja! 😄\nCoba tanya: skills, projects, contact, CV, about — nanti aku jelasin!',
        ok: 'Baik! 😊 Ada lagi yang ditanyakan?',
        hello: 'Halo! Senang bertemu denganmu! 😊\nAda yang bisa saya bantu tentang portofolio ini?',
        projects: '🚀 Ada beberapa project keren di sini!\nDari Web App, Mobile App, hingga Branding.\nKlik "View All Projects" untuk lihat semuanya!',
        skills: '💡 Tech stack yang dikuasai:\nLaravel, Vue.js, React, Node.js, MySQL, dan masih banyak lagi.\nCek section Skills untuk detail!',
        contact: '📬 Tertarik bekerja sama?\nScroll ke section Contact atau klik tombol email di bawah halaman ini!',
        cv: '📄 CV tersedia untuk didownload!\nScroll ke Hero section dan klik tombol "Download CV".',
        about: '👨‍💻 Ini portofolio seorang Full Stack Developer.\nScroll ke section About untuk info lengkapnya!',
        github: '🐙 Link GitHub tersedia di setiap project card!\nKlik project yang kamu minati untuk lihat source code-nya.',
        blog: '📝 Fitur Blog sedang dalam pengembangan.\nPantau terus update portofolio ini!',
        price: '💰 Untuk info harga dan paket layanan,\nsilakan hubungi langsung melalui form Contact.\nNanti akan dibalas secepatnya!',
        experience: '⚡ Pengalaman bisa dilihat di section Experience!\nScroll ke bawah untuk timeline lengkapnya!',
        fallback: 'Maaf, saya kurang paham maksudnya. 😅\nCoba tanya tentang: projects, skills, contact, CV, about, atau sapa aja!\nAtau langsung hubungi via form Contact ya!',
        ...i18n,
    };

    return {
        open: false,
        loading: false,
        input: '',
        messages: [
            {
                role: 'bot',
                text: t.greeting,
                time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            }
        ],

        async send() {
            const userMsg = this.input.trim();
            if (!userMsg || this.loading) return;

            this.input = '';
            this.messages.push({
                role: 'user',
                text: userMsg,
                time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            });
            this.loading = true;
            this.scrollBottom();

            let reply;

            try {
                const res = await fetch('/chatbot/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                    },
                    body: JSON.stringify({ message: userMsg }),
                });

                const data = await res.json();

                if ((data.source === 'gemini' || data.source === 'openrouter') && data.reply) {
                    reply = data.reply;
                } else {
                    throw new Error('fallback');
                }
            } catch {
                await new Promise(r => setTimeout(r, 400 + Math.random() * 600));
                reply = this.getReply(userMsg.toLowerCase());
            }

            this.loading = false;
            this.messages.push({
                role: 'bot',
                text: reply,
                time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            });
            await this.$nextTick();
            this.scrollBottom();
        },

        scrollBottom() {
            this.$nextTick(() => {
                if (this.$refs.chatBody)
                    this.$refs.chatBody.scrollTop = this.$refs.chatBody.scrollHeight;
            });
        },

        getReply(msg) {
            if (/apa kabar|gimana kabar|baik|kabar|sehat|how are you/.test(msg))
                return t.how_are_you;
            if (/siapa (nama|kamu)|nama kamu|namamu|lo siapa|lu siapa|kau siapa|who are you|your name/.test(msg))
                return t.who_are_you;
            if (/kamu (dari mana|tinggal|asal|dimana)|dari mana|where.*from/.test(msg))
                return t.where_from;
            if (/lagi apa|lagi ngapain|sibuk|ngapain|what.*doing|busy/.test(msg))
                return t.what_doing;
            if (/makasih|terima kasih|thanks|thank you|tq/.test(msg))
                return t.thanks;
            if (/hebat|pinter|keren|mantap|good|nice|great|wow|kereen/.test(msg))
                return t.praise;
            if (/ga tau|gatau|tidak tahu|nggak tahu|gk tau|bodo|bingung|don'?t know|i don'?t know/.test(msg))
                return t.dont_know;
            if (/oke|ok|baik|baiklah|sip|siap|yes|iyes|ya|y/.test(msg) && msg.length < 5)
                return t.ok;
            if (/halo|hai|hi|hello|hey|pagi|siang|sore|malam/.test(msg))
                return t.hello;
            if (/project|karya|portfolio|work/.test(msg))
                return t.projects;
            if (/skill|teknologi|tech|stack|bahasa/.test(msg))
                return t.skills;
            if (/kontak|contact|hire|freelance|kerja sama|kolaborasi/.test(msg))
                return t.contact;
            if (/cv|resume|download/.test(msg))
                return t.cv;
            if (/about|tentang|profil/.test(msg))
                return t.about;
            if (/github|source|code|repo/.test(msg))
                return t.github;
            if (/blog|artikel|tulisan/.test(msg))
                return t.blog;
            if (/harga|price|biaya|rate|tarif/.test(msg))
                return t.price;
            if (/pengalaman|experience|berapa lama|tahun/.test(msg))
                return t.experience;
            return t.fallback;
        }
    };
}
