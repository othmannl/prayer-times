let prayerTimes = {};
const adan = new Audio('adan.mp3');


function updateClock() {
    const now = new Date();
    const options = {
        year: 'numeric',
        month: 'long',
        weekday: 'long',
        day: 'numeric'
    };
    document.getElementById('date').textContent = now.toLocaleDateString('en-GB', options);

    const hours = String(now.getHours()).padStart(2 ,'0');
    const minutes = String(now.getMinutes()).padStart(2 ,'0'); ; 
    const seconds = String(now.getSeconds()).padStart(2, '0'); ;
    document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`

    if (Object.keys(prayerTimes).length > 0) {
        const currentTime = `${hours}:${minutes}`;
        if (Object.values(prayerTimes).includes(currentTime)) {
            adan.play();
        }
    }

    }


  async function fetchPrayerTimes() {
  const response = await fetch('prayer_times.php');
   prayerTimes = await response.json();

   document.getElementById('fajr-time').textContent = prayerTimes.fajr;
   document.getElementById('dhuhr-time').textContent = prayerTimes.dhuhr;
   document.getElementById('asr-time').textContent = prayerTimes.asr;
   document.getElementById('maghrib-time').textContent = prayerTimes.maghrib;
   document.getElementById('isha-time').textContent = prayerTimes.isha;

 }


setInterval(updateClock, 1000);
fetchPrayerTimes();