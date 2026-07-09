export function chatbot() {
    return {
        open: false,
        loading: false,
        input: '',
        messages: [
            {
                role: 'bot',
                text: 'Halo! 👋 Saya AI Assistant portofolio ini.\nTanyakan apa saja: skills, projects, cara kontak, atau info lainnya!',
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
            if (/apa kabar|gimana kabar|baik|kabar|sehat/.test(msg))
                return 'Kabarku baik! Lagi siap bantu-bantu di sini. 😊\nAda yang bisa saya bantu tentang portofolio?';
            if (/siapa (nama|kamu)|nama kamu|namamu|lo siapa|lu siapa|kau siapa/.test(msg))
                return 'Aku AI Assistant portofolio ini! 🤖\nTugasku bantu jelasin tentang projects, skills, atau apapun yang kamu penasaran.';
            if (/kamu (dari mana|tinggal|asal|dimana)|dari mana/.test(msg))
                return 'Aku tinggal di web ini aja! 😄\nTapi yang punya portofolio ini dari Indonesia — Full Stack Developer.\nAda yang mau ditanya?';
            if (/lagi apa|lagi ngapain|sibuk|ngapain/.test(msg))
                return 'Lagi nunggu pertanyaan dari kamu! 🫡\nAda yang pengen ditanya tentang portofolio ini?';
            if (/makasih|terima kasih|thanks|thank you|tq/.test(msg))
                return 'Sama-sama! 😊\nJangan ragu untuk tanya-tanya lagi ya!';
            if (/hebat|pinter|keren|mantap|good|nice|great|wow|kereen/.test(msg))
                return 'Makasih! 🙌 Senang denger kalau kamu suka!\nAda lagi yang mau ditanya?';
            if (/ga tau|gatau|tidak tahu|nggak tahu|gk tau|bodo|bingung/.test(msg))
                return 'Santai aja! 😄\nCoba tanya: skills, projects, contact, CV, about — nanti aku jelasin!';
            if (/oke|ok|baik|baiklah|sip|siap|yes|iyes|ya|y/.test(msg) && msg.length < 5)
                return 'Baik! 😊 Ada lagi yang ditanyakan?';
            if (/halo|hai|hi|hello|hey|pagi|siang|sore|malam/.test(msg))
                return 'Halo! Senang bertemu denganmu! 😊\nAda yang bisa saya bantu tentang portofolio ini?';
            if (/project|karya|portfolio|work/.test(msg))
                return '🚀 Ada beberapa project keren di sini!\nDari Web App, Mobile App, hingga Branding.\nKlik "View All Projects" untuk lihat semuanya!';
            if (/skill|teknologi|tech|stack|bahasa/.test(msg))
                return '💡 Tech stack yang dikuasai:\nLaravel, Vue.js, React, Node.js, MySQL, dan masih banyak lagi.\nCek section Skills untuk detail!';
            if (/kontak|contact|hire|freelance|kerja sama|kolaborasi/.test(msg))
                return '📬 Tertarik bekerja sama?\nScroll ke section Contact atau klik tombol email di bawah halaman ini!';
            if (/cv|resume|download/.test(msg))
                return '📄 CV tersedia untuk didownload!\nScroll ke Hero section dan klik tombol "Download CV".';
            if (/about|tentang|profil/.test(msg))
                return '👨‍💻 Ini portofolio seorang Full Stack Developer.\nScroll ke section About untuk info lengkapnya!';
            if (/github|source|code|repo/.test(msg))
                return '🐙 Link GitHub tersedia di setiap project card!\nKlik project yang kamu minati untuk lihat source code-nya.';
            if (/blog|artikel|tulisan/.test(msg))
                return '📝 Fitur Blog sedang dalam pengembangan.\nPantau terus update portofolio ini!';
            if (/harga|price|biaya|rate|tarif/.test(msg))
                return '💰 Untuk info harga dan paket layanan,\nsilakan hubungi langsung melalui form Contact.\nNanti akan dibalas secepatnya!';
            if (/pengalaman|experience|berapa lama|tahun/.test(msg))
                return '⚡ Pengalaman bisa dilihat di section Experience!\nScroll ke bawah untuk timeline lengkapnya!';
            return 'Maaf, saya kurang paham maksudnya. 😅\nCoba tanya tentang: projects, skills, contact, CV, about, atau sapa aja!\nAtau langsung hubungi via form Contact ya!';
        }
    };
}
