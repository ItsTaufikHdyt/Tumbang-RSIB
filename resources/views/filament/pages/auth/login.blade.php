<x-filament-panels::page.simple>

    <style>
        .fi-simple-main {
            max-width: 980px !important;
            padding: 0 !important;
            overflow: hidden;

            border-radius: 22px !important;

            box-shadow:
                0 25px 70px
                rgba(15, 23, 42, .14) !important;
        }

        .fi-simple-header {
            display: none !important;
        }

        .login-wrapper {
            display: grid;
            grid-template-columns: .9fr 1.1fr;

            min-height: 570px;

            background: white;
        }

        .login-brand {
            position: relative;
            overflow: hidden;

            padding: 48px;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            color: white;

            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(255, 255, 255, .15),
                    transparent 30%
                ),
                linear-gradient(
                    145deg,
                    #0369a1,
                    #0891b2
                );
        }

        .login-brand::after {
            content: "";

            position: absolute;

            width: 260px;
            height: 260px;

            right: -100px;
            bottom: -100px;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, .08);
        }

        .login-logo {
            width: 85px;
            height: 85px;

            padding: 8px;

            object-fit: contain;

            background: rgba(255, 255, 255, .95);

            border-radius: 16px;
        }

        .brand-content {
            position: relative;
            z-index: 2;

            margin-top: 45px;
        }

        .brand-label {
            display: inline-block;

            margin-bottom: 14px;
            padding: 6px 10px;

            background: rgba(255, 255, 255, .13);

            border: 1px solid
                rgba(255, 255, 255, .16);

            border-radius: 999px;

            font-size: 11px;
            font-weight: 700;
        }

        .brand-content h1 {
            margin: 0;

            font-size: 31px;
            line-height: 1.2;

            font-weight: 800;
        }

        .brand-content p {
            margin-top: 16px;

            font-size: 14px;
            line-height: 1.8;

            color: rgba(255, 255, 255, .78);
        }

        .brand-footer {
            position: relative;
            z-index: 2;

            font-size: 11px;

            color: rgba(255, 255, 255, .65);
        }

        .login-form-section {
            padding: 55px 52px;

            display: flex;
            align-items: center;

            background: white;
        }

        .login-form-container {
            width: 100%;
        }

        .login-form-header {
            margin-bottom: 30px;
        }

        .login-form-header h2 {
            margin: 0;

            color: #0f172a;

            font-size: 26px;
            font-weight: 800;

            letter-spacing: -.5px;
        }

        .login-form-header p {
            margin-top: 8px;

            color: #64748b;

            font-size: 13px;
            line-height: 1.6;
        }

        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            margin-top: 24px;

            color: #64748b;

            font-size: 12px;
            font-weight: 600;

            text-decoration: none;
        }

        .back-home:hover {
            color: #0284c7;
        }

        @media (max-width: 760px) {

            .fi-simple-main {
                max-width: 430px !important;
            }

            .login-wrapper {
                display: block;
                min-height: auto;
            }

            .login-brand {
                padding: 30px;

                min-height: 220px;
            }

            .login-logo {
                width: 65px;
                height: 65px;
            }

            .brand-content {
                margin-top: 25px;
            }

            .brand-content h1 {
                font-size: 24px;
            }

            .brand-content p {
                margin-top: 8px;
            }

            .brand-footer {
                display: none;
            }

            .login-form-section {
                padding: 35px 30px;
            }
        }
    </style>


    <div class="login-wrapper">

        {{-- LEFT SIDE --}}
        <div class="login-brand">

            <div>

                <img
                    src="{{ asset('images/rsib.png') }}"
                    alt="Logo RSIB"
                    class="login-logo"
                >

                <div class="brand-content">

                    <div class="brand-label">
                        Klinik Tumbuh Kembang RSIB
                    </div>

                    <h1>
                        Tumbang
                        <br>
                        Smart Kids
                    </h1>

                    <p>
                        Sistem monitoring dan evaluasi
                        perkembangan anak untuk membantu
                        proses terapi menjadi lebih
                        terstruktur dan terdokumentasi.
                    </p>

                </div>

            </div>


            <div class="brand-footer">
                Tumbang Smart Kids RSIB
            </div>

        </div>


        {{-- RIGHT SIDE --}}
        <div class="login-form-section">

            <div class="login-form-container">

                <div class="login-form-header">

                    <h2>
                        Selamat Datang
                    </h2>

                    <p>
                        Masukkan email dan password Anda
                        untuk mengakses sistem.
                    </p>

                </div>


                <form
                    wire:submit="authenticate"
                >

                    {{ $this->form }}

                    <x-filament::button
                        type="submit"
                        form="authenticate"
                        class="w-full"
                    >
                        Masuk ke Sistem
                    </x-filament::button>

                </form>


                <a
                    href="{{ route('home') }}"
                    class="back-home"
                >
                    ← Kembali ke halaman utama
                </a>

            </div>

        </div>

    </div>

</x-filament-panels::page.simple>