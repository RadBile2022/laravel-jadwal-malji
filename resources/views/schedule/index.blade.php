<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
<title>Info Kajian Sunnah Malang Batu - Malang Mengaji</title>
<meta name="description" content="Temukan info kajian sunnah di Malang, Batu. Jadwal kajian sunnah harian, lengkap dengan info asatidz dan lokasi.">
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="canonical" href="https://kajian.malangmengaji.com/">
    
<meta name="google-site-verification" content="oGS2mqXaelX5hn-eMrZCvr2BjBAQ9PT5rwSyG502Zgw" />    

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-G0LX2VE2K0"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-G0LX2VE2K0');
</script>

    <link rel="icon" type="image/png" href="/assets/malji-favicon.png">
    <link rel="icon" href="/assets/malji-favicon.png" type="image/x-icon">

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    borderWidth: {
                        '3': '3px',
                    }
                }
            }
        }
    </script>
    <style>
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .animate-fade-in { animation: fadeIn 0.5s ease-in; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-200 text-slate-800 leading-relaxed">
    <div class="max-w-[430px] mx-auto bg-white min-h-screen relative shadow-2xl">
        <!-- Header -->
        <div class="relative bg-gradient-to-br from-slate-800 to-slate-600 text-white pt-[20px] pb-8 px-6 text-center">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-orange-500 to-orange-600"></div>
            <img src="/assets/logo1.svg" alt="Logo Info Kajian" class="mx-auto my-3 max-h-[50px] object-contain" />
            <h1 class="text-[22px] font-bold mb-2 tracking-tight">INFO KAJIAN MALANG RAYA</h1>
            <!--<p class="text-sm my-1">by</p>-->
     <!--       <img src="/assets/logo.png" alt="Logo Info Kajian"-->
     <!--class="mx-auto my-1  object-fit" />-->
            <p id="current-day-text" class="text-base opacity-90 font-normal hidden"> Hari Senin</p>
            <p class="text-base opacity-90 font-normal hidden"> Tanggal Hari Ini </p>
            <p class="text-sm mt-1">
                <span id="tanggal-masehi" ></span> /
                <span  id="tanggal-hijriah"></span>
            </p>
            <p class="text-sm opacity-80"></p>
           
        </div>

        <!-- Tabs px-6  -->
  <div class="flex bg-white border-b border-slate-200">
  @foreach(['senin','selasa','rabu','kamis','jumat','sabtu','ahad'] as $day)
    <div
      class="tab flex-1 cursor-pointer border-b-3 transition-all duration-300 whitespace-nowrap font-medium text-center py-4 text-slate-500 border-transparent hover:text-orange-500 hover:bg-orange-50"
      data-day="{{ $day }}">
      {{ ucfirst($day) }}
    </div>
  @endforeach
</div>


        <!--<div class="flex bg-white border-b border-slate-200 overflow-x-auto scrollbar-hide">-->
        <!--    @foreach(['senin','selasa','rabu','kamis','jumat','sabtu','ahad'] as $day)-->
        <!--    <div class="tab px-1.5 py-4 cursor-pointer border-b-3 transition-all duration-300 whitespace-nowrap font-medium min-w-fit text-slate-500 border-transparent hover:text-orange-500 hover:bg-orange-50" data-day="{{ $day }}">-->
        <!--        {{ ucfirst($day) }}-->
        <!--    </div>-->
        <!--    @endforeach-->
        <!--</div>-->

        <!-- Content -->
        <div class="p-6 min-h-[calc(100vh-200px)]">
            <div class="loading hidden justify-center items-center py-10" id="loading">
                <div class="w-6 h-6 border-2 border-slate-200 border-t-orange-500 rounded-full animate-spin"></div>
            </div>
            <div id="schedule-content" class="animate-fade-in"></div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-6 text-center text-slate-500 text-xs border-t border-slate-200 bg-slate-50">
            <p>© 2025 Malang Mengaji. Semoga bermanfaat untuk umat.</p>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const masehiOptions = { year: 'numeric', month: 'long', day: 'numeric' };
        const today = new Date();

        // Format tanggal Masehi (Indonesia, tanpa hari)
        const masehi = today.toLocaleDateString('id-ID', masehiOptions);
        document.getElementById('tanggal-masehi').textContent = masehi;

        // Format Hijriah (angka Latin, bulan Hijriah nama Latin)
        const islamicFormatter = new Intl.DateTimeFormat('en-TN-u-ca-islamic', {
            day: 'numeric',
            month: 'numeric',
            year: 'numeric',
        });

        const parts = islamicFormatter.formatToParts(today);
        const hijriDay = parts.find(p => p.type === 'day')?.value;
        const hijriMonth = parts.find(p => p.type === 'month')?.value;
        const hijriYear = parts.find(p => p.type === 'year')?.value;

        const hijriMonths = [
            'Muharram', 'Safar', 'Rabiul Awal', 'Rabiul Akhir', 'Jumadil Awal', 'Jumadil Akhir',
            'Rajab', 'Sya\'ban', 'Ramadhan', 'Syawal', 'Zulkaidah', 'Zulhijjah'
        ];

        const bulanHijriah = hijriMonths[parseInt(hijriMonth) - 1];
        const hijriahText = `${hijriDay} ${bulanHijriah} ${hijriYear} H`;

        document.getElementById('tanggal-hijriah').textContent = hijriahText;
    });
</script>
    <script>
        const scheduleData = @json($scheduleData);

        const dayNames = {
            0: 'ahad',
            1: 'senin', 2: 'selasa', 3: 'rabu',
            4: 'kamis', 5: 'jumat', 6: 'sabtu'
        };

        const dayDisplayNames = {
            'senin': 'Senin', 'selasa': 'Selasa', 'rabu': 'Rabu',
            'kamis': 'Kamis', 'jumat': 'Jumat', 'sabtu': 'Sabtu',
            'ahad': 'Ahad'
        };

        function getCurrentDay() {
            const today = new Date();
            return dayNames[today.getDay()] || 'senin';
        }

        function showLoading() {
            document.getElementById('loading').classList.remove('hidden');
            document.getElementById('loading').classList.add('flex');
            document.getElementById('schedule-content').style.display = 'none';
        }

        function hideLoading() {
            document.getElementById('loading').classList.add('hidden');
            document.getElementById('loading').classList.remove('flex');
            document.getElementById('schedule-content').style.display = 'block';
        }

        function renderSchedule(day) {
            showLoading();

            setTimeout(() => {
                const container = document.getElementById('schedule-content');
                const data = scheduleData[day] || [];
                const filtered = data.filter(item =>  item.is_shown);
// !item.is_free &&
                document.getElementById('current-day-text').textContent = `Hari ${dayDisplayNames[day]}`;

                if (filtered.length === 0) {
                    container.innerHTML = `
                        <div class="text-center py-[60px] px-5 text-slate-500">
                            <div class="w-12 h-12 mx-auto mb-4 opacity-50">
                                <i data-lucide="calendar-x"></i>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Tidak Ada Jadwal</h3>
                            <p>Belum ada kajian terjadwal untuk hari ${dayDisplayNames[day]}</p>
                        </div>`;
                } else {
                    let html = '<div class="space-y-4">';
                    filtered.forEach(item => {
                        html += `
                        
                            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg relative overflow-hidden group">
                                <div class="absolute top-0 left-0 w-1 h-full bg-orange-500"></div>
                                <a href="${item.link_map || '#'}" class="">
                                <div class="space-y-3">
                                
                                    <div class="flex items-center gap-3">
                                        <i data-lucide="clock" class="w-5 h-5 text-slate-500 flex-shrink-0"></i>
                                        <span class="text-sm text-slate-700 font-medium">${item.time}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <i data-lucide="book-open" class="w-5 h-5 text-slate-500 flex-shrink-0"></i>
                                        <span class="text-sm text-slate-700 font-medium">Topik: ${item.topic}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <i data-lucide="user" class="w-5 h-5 text-slate-500 flex-shrink-0"></i>
                                        <span class="text-sm text-slate-700 font-medium">Pemateri: ${item.speaker}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <i data-lucide="map-pin" class="w-5 h-5 text-slate-500 flex-shrink-0"></i>
                                        <span class="text-sm text-slate-700 font-medium">Tempat: 
                                        
                                         <span class="underline underline-offset-2 decoration-orange-600">${item.place}</span>
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <i data-lucide="map-pin" class="w-5 h-5 text-slate-500 flex-shrink-0"></i>
                                        <span class="text-sm text-slate-700 font-medium">Alamat: ${item.place_address}</span>
                                    </div>
        
        
                                    ${
  item.information !== 'Kajian Umum'
    ? `
      <div class="flex justify-center">
        <span class="text-sm font-medium ${
          item.information === 'Khusus Ikhwan' ? 'text-green-600' :
          item.information === 'Khusus Akhwat' ? 'text-pink-500' :
          item.information === 'Libur' ? 'text-red-600' :
          'text-orange-600'
        }">
          ${ item.information }
        </span>
      </div>
      `
    : ''
}
                                    
                                        <div class="flex justify-center">
                                       <span class="text-sm text-orange-600 font-medium">${ item.information_systems } </span>
                                    </div>
    
                                    </div>
                                </a>
                            </div>
                            `;
                    });
                    html += '</div>';
                    container.innerHTML = html;
                }

                lucide.createIcons();
                hideLoading();
                container.classList.remove('animate-fade-in');
                setTimeout(() => container.classList.add('animate-fade-in'), 10);
            }, 300);
        }

        function setActiveTab(day) {
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('text-orange-500', 'border-orange-500', 'bg-orange-50', 'font-semibold');
                tab.classList.add('text-slate-500', 'border-transparent');
            });

            const selectedTab = document.querySelector(`[data-day="${day}"]`);
            if (selectedTab) {
                selectedTab.classList.remove('text-slate-500', 'border-transparent');
                selectedTab.classList.add('text-orange-500', 'border-orange-500', 'bg-orange-50', 'font-semibold');
            }
        }

        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function () {
                const day = this.getAttribute('data-day');
                setActiveTab(day);
                renderSchedule(day);
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const currentDay = getCurrentDay();
            setActiveTab(currentDay);
            renderSchedule(currentDay);
            lucide.createIcons();
        });

        setInterval(() => {
            const newDay = getCurrentDay();
            const active = document.querySelector('.tab.text-orange-500');
            const currentDay = active ? active.getAttribute('data-day') : 'senin';

            if (newDay !== currentDay) {
                setActiveTab(newDay);
                renderSchedule(newDay);
            }
        }, 3600000);
    </script>
</body>
</html>
