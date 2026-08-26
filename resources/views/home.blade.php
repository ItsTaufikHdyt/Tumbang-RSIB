<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tumbang Smart Kids RSIB</title>

    <meta
        name="description"
        content="Sistem Monitoring dan Evaluasi Tumbuh Kembang Anak RSIB"
    >

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --secondary: #0891b2;
            --background: #f8fafc;
            --surface: #ffffff;
            --text: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            background: var(--background);
            color: var(--text);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
        }

        .container {
            width: min(1120px, calc(100% - 40px));
            margin: 0 auto;
        }

        /* ==========================
           NAVBAR
        ========================== */

        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;

            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(12px);

            border-bottom: 1px solid rgba(226, 232, 240, .8);
        }

        .navbar-inner {
            min-height: 76px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;

            color: var(--text);
        }

        .brand-logo {
            width: 48px;
            height: 48px;

            object-fit: contain;
        }

        .brand-title {
            font-size: 16px;
            font-weight: 800;
            line-height: 1.2;
        }

        .brand-subtitle {
            margin-top: 3px;

            font-size: 12px;
            color: var(--text-muted);
        }

        .login-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            min-height: 44px;
            padding: 0 20px;

            background: var(--primary);
            color: white;

            border-radius: 10px;

            font-size: 14px;
            font-weight: 700;

            transition: .2s ease;
        }

        .login-button:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        /* ==========================
           HERO
        ========================== */

        .hero {
            position: relative;
            overflow: hidden;

            padding: 90px 0 100px;

            background:
                radial-gradient(
                    circle at 85% 20%,
                    rgba(14, 165, 233, .14),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 10% 90%,
                    rgba(6, 182, 212, .10),
                    transparent 30%
                ),
                linear-gradient(
                    180deg,
                    #ffffff 0%,
                    #f8fafc 100%
                );
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: 70px;
            align-items: center;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 7px 12px;

            background: var(--primary-light);
            color: var(--primary-dark);

            border-radius: 999px;

            font-size: 12px;
            font-weight: 800;

            margin-bottom: 22px;
        }

        .eyebrow-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;
            background: var(--primary);
        }

        .hero h1 {
            max-width: 700px;

            font-size: clamp(38px, 5vw, 62px);
            line-height: 1.08;
            letter-spacing: -2px;
        }

        .hero h1 span {
            color: var(--primary);
        }

        .hero-description {
            max-width: 630px;

            margin-top: 24px;

            font-size: 17px;
            line-height: 1.8;

            color: var(--text-muted);
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;

            margin-top: 32px;
        }

        .primary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            min-height: 50px;
            padding: 0 24px;

            background: var(--primary);
            color: white;

            border-radius: 11px;

            font-size: 14px;
            font-weight: 800;

            transition: .2s ease;
        }

        .primary-button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .secondary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 50px;
            padding: 0 24px;

            background: white;
            color: var(--text);

            border: 1px solid var(--border);
            border-radius: 11px;

            font-size: 14px;
            font-weight: 700;

            transition: .2s ease;
        }

        .secondary-button:hover {
            border-color: #bae6fd;
            background: #f0f9ff;
        }

        /* ==========================
           HERO CARD
        ========================== */

        .hero-visual {
            position: relative;
        }

        .dashboard-card {
            position: relative;
            z-index: 2;

            padding: 28px;

            background: rgba(255, 255, 255, .94);

            border: 1px solid var(--border);
            border-radius: 24px;

            box-shadow:
                0 30px 70px rgba(15, 23, 42, .10);
        }

        .dashboard-header {
            display: flex;
            align-items: center;
            gap: 14px;

            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .dashboard-logo {
            width: 55px;
            height: 55px;

            object-fit: contain;
        }

        .dashboard-title {
            font-size: 16px;
            font-weight: 800;
        }

        .dashboard-subtitle {
            margin-top: 3px;

            font-size: 12px;
            color: var(--text-muted);
        }

        .dashboard-content {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;

            margin-top: 22px;
        }

        .mini-card {
            padding: 18px;

            background: #f8fafc;

            border: 1px solid var(--border);
            border-radius: 14px;
        }

        .mini-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 14px;

            border-radius: 10px;

            background: var(--primary-light);
            color: var(--primary);

            font-size: 19px;
        }

        .mini-title {
            font-size: 13px;
            font-weight: 800;
        }

        .mini-description {
            margin-top: 4px;

            font-size: 11px;
            color: var(--text-muted);
        }

        .decoration {
            position: absolute;

            width: 180px;
            height: 180px;

            right: -55px;
            bottom: -55px;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    rgba(14, 165, 233, .18),
                    rgba(6, 182, 212, .08)
                );
        }

        /* ==========================
           FEATURES
        ========================== */

        .features {
            padding: 90px 0;

            background: white;
        }

        .section-header {
            max-width: 680px;
            margin: 0 auto 50px;

            text-align: center;
        }

        .section-label {
            color: var(--primary);

            font-size: 12px;
            font-weight: 800;

            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .section-header h2 {
            margin-top: 10px;

            font-size: 34px;
            letter-spacing: -1px;
        }

        .section-header p {
            margin-top: 12px;

            color: var(--text-muted);
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .feature-card {
            padding: 26px;

            border: 1px solid var(--border);
            border-radius: 16px;

            background: white;

            transition: .2s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);

            border-color: #bae6fd;

            box-shadow:
                0 18px 40px rgba(15, 23, 42, .07);
        }

        .feature-icon {
            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 18px;

            border-radius: 12px;

            background: var(--primary-light);

            font-size: 22px;
        }

        .feature-card h3 {
            font-size: 16px;
        }

        .feature-card p {
            margin-top: 8px;

            font-size: 13px;
            line-height: 1.7;

            color: var(--text-muted);
        }

        /* ==========================
           CTA
        ========================== */

        .cta-section {
            padding: 80px 0;
        }

        .cta {
            padding: 55px;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;

            background:
                linear-gradient(
                    135deg,
                    #0369a1,
                    #0891b2
                );

            border-radius: 24px;

            color: white;
        }

        .cta h2 {
            font-size: 30px;
        }

        .cta p {
            max-width: 600px;

            margin-top: 8px;

            color: rgba(255, 255, 255, .8);
        }

        .cta-button {
            flex-shrink: 0;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 48px;
            padding: 0 24px;

            background: white;
            color: var(--primary-dark);

            border-radius: 10px;

            font-size: 14px;
            font-weight: 800;
        }

        /* ==========================
           FOOTER
        ========================== */

        footer {
            padding: 28px 0;

            background: white;
            border-top: 1px solid var(--border);
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            font-size: 12px;
            color: var(--text-muted);
        }

        /* ==========================
           RESPONSIVE
        ========================== */

        @media (max-width: 900px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 50px;
            }

            .hero {
                padding-top: 65px;
            }

            .feature-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .cta {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 600px) {
            .container {
                width: min(100% - 28px, 1120px);
            }

            .brand-subtitle {
                display: none;
            }

            .brand-logo {
                width: 42px;
                height: 42px;
            }

            .login-button {
                padding: 0 14px;
            }

            .hero {
                padding: 55px 0 70px;
            }

            .hero h1 {
                font-size: 40px;
                letter-spacing: -1.5px;
            }

            .hero-description {
                font-size: 15px;
            }

            .hero-actions {
                flex-direction: column;
            }

            .primary-button,
            .secondary-button {
                width: 100%;
            }

            .dashboard-card {
                padding: 20px;
            }

            .dashboard-content {
                grid-template-columns: 1fr;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .features {
                padding: 70px 0;
            }

            .cta-section {
                padding: 50px 0;
            }

            .cta {
                padding: 35px 25px;
            }

            .cta-button {
                width: 100%;
            }

            .footer-inner {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<header class="navbar">
    <div class="container navbar-inner">

        <a href="{{ route('home') }}" class="brand">
            <img
                src="{{ asset('images/rsib.png') }}"
                alt="Logo RSIB"
                class="brand-logo"
            >

            <div>
                <div class="brand-title">
                    Tumbang Smart Kids
                </div>

                <div class="brand-subtitle">
                    Klinik Tumbuh Kembang RSIB
                </div>
            </div>
        </a>

        <a
            href="{{ url('/admin/login') }}"
            class="login-button"
        >
            Masuk
            <span>→</span>
        </a>

    </div>
</header>


<main>

    <section class="hero">

        <div class="container hero-grid">

            <div>

                <div class="eyebrow">
                    <span class="eyebrow-dot"></span>
                    Sistem Informasi Tumbuh Kembang
                </div>

                <h1>
                    Monitoring perkembangan anak
                    <span>lebih terstruktur.</span>
                </h1>

                <p class="hero-description">
                    Sistem digital untuk membantu terapis
                    melakukan pencatatan evaluasi, pemantauan
                    perkembangan setiap aktivitas, pengelolaan
                    laporan, dan administrasi pasien Tumbang
                    Smart Kids RSIB.
                </p>

                <div class="hero-actions">

                    <a
                        href="{{ url('/admin/login') }}"
                        class="primary-button"
                    >
                        Masuk ke Sistem
                        <span>→</span>
                    </a>

                    <a
                        href="#fitur"
                        class="secondary-button"
                    >
                        Pelajari Fitur
                    </a>

                </div>

            </div>


            <div class="hero-visual">

                <div class="dashboard-card">

                    <div class="dashboard-header">

                        <img
                            src="{{ asset('images/rsib.png') }}"
                            alt="RSIB"
                            class="dashboard-logo"
                        >

                        <div>
                            <div class="dashboard-title">
                                Tumbang Smart Kids
                            </div>

                            <div class="dashboard-subtitle">
                                Monitoring & Evaluasi Anak
                            </div>
                        </div>

                    </div>


                    <div class="dashboard-content">

                        <div class="mini-card">
                            <div class="mini-icon">👶</div>

                            <div class="mini-title">
                                Data Pasien
                            </div>

                            <div class="mini-description">
                                Kelola biodata dan informasi
                                pasien secara terpusat.
                            </div>
                        </div>


                        <div class="mini-card">
                            <div class="mini-icon">📋</div>

                            <div class="mini-title">
                                Evaluasi D/S
                            </div>

                            <div class="mini-description">
                                Pencatatan skor aktivitas pada
                                setiap sesi evaluasi.
                            </div>
                        </div>


                        <div class="mini-card">
                            <div class="mini-icon">📈</div>

                            <div class="mini-title">
                                Perkembangan
                            </div>

                            <div class="mini-description">
                                Pantau perkembangan setiap
                                aktivitas secara longitudinal.
                            </div>
                        </div>


                        <div class="mini-card">
                            <div class="mini-icon">📄</div>

                            <div class="mini-title">
                                Laporan
                            </div>

                            <div class="mini-description">
                                Preview, cetak, dan export
                                laporan dalam format PDF.
                            </div>
                        </div>

                    </div>

                </div>

                <div class="decoration"></div>

            </div>

        </div>

    </section>


    <section
        class="features"
        id="fitur"
    >

        <div class="container">

            <div class="section-header">

                <div class="section-label">
                    Fitur Utama
                </div>

                <h2>
                    Mendukung proses evaluasi dari awal
                    hingga pelaporan
                </h2>

                <p>
                    Seluruh proses pencatatan perkembangan
                    anak tersimpan dalam satu sistem yang
                    terstruktur dan mudah digunakan.
                </p>

            </div>


            <div class="feature-grid">

                <div class="feature-card">
                    <div class="feature-icon">👶</div>

                    <h3>Manajemen Pasien</h3>

                    <p>
                        Kelola identitas pasien, data orang tua,
                        alamat, serta informasi dasar anak.
                    </p>
                </div>


                <div class="feature-card">
                    <div class="feature-icon">📝</div>

                    <h3>Aktivitas Per Anak</h3>

                    <p>
                        Setiap anak dapat memiliki indikator
                        dan aktivitas terapi yang berbeda.
                    </p>
                </div>


                <div class="feature-card">
                    <div class="feature-icon">🎯</div>

                    <h3>Evaluasi D/S</h3>

                    <p>
                        Terapis memberikan skor 0, 3, 7,
                        atau 10 pada setiap aktivitas.
                    </p>
                </div>


                <div class="feature-card">
                    <div class="feature-icon">📈</div>

                    <h3>Grafik Perkembangan</h3>

                    <p>
                        Visualisasi perubahan kemampuan anak
                        untuk setiap aktivitas dari waktu
                        ke waktu.
                    </p>
                </div>


                <div class="feature-card">
                    <div class="feature-icon">📄</div>

                    <h3>Laporan PDF</h3>

                    <p>
                        Preview dan cetak laporan perkembangan
                        anak dalam format dokumen PDF.
                    </p>
                </div>


                <div class="feature-card">
                    <div class="feature-icon">🏥</div>

                    <h3>Administrasi Surat</h3>

                    <p>
                        Membantu pembuatan Surat Keterangan
                        Dalam Perawatan berdasarkan data pasien.
                    </p>
                </div>

            </div>

        </div>

    </section>


    <section class="cta-section">

        <div class="container">

            <div class="cta">

                <div>
                    <h2>
                        Tumbang Smart Kids RSIB
                    </h2>

                    <p>
                        Akses sistem untuk melakukan pengelolaan
                        pasien, evaluasi, monitoring perkembangan,
                        dan administrasi layanan.
                    </p>
                </div>

                <a
                    href="{{ url('/admin/login') }}"
                    class="cta-button"
                >
                    Masuk ke Sistem →
                </a>

            </div>

        </div>

    </section>

</main>


<footer>

    <div class="container footer-inner">

        <div>
            © {{ date('Y') }} Tumbang Smart Kids RSIB
        </div>

        <div>
            Sistem Monitoring & Evaluasi Tumbuh Kembang Anak
        </div>

    </div>

</footer>

</body>
</html>