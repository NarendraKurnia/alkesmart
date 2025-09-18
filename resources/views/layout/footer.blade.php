
<!-- Footer -->
<footer class="bg-green-900 text-white py-10">
    <div class="max-w-7xl mx-auto px-4 space-y-8">

        <!-- Logo -->
        <div class="text-left md:text-left">
            <h1 class="text-3xl font-serif tracking-wide">MORAClub</h1>
        </div>

        <hr class="border-t border-yellow-500">

        <!-- Contact + Navigation -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Social Media -->
            <div class="flex justify-center md:justify-start space-x-4 text-xl">
                <a href="https://facebook.com" target="_blank" class="hover:text-blue-600"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com" target="_blank" class="hover:text-sky-500"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com" target="_blank" class="hover:text-pink-500"><i class="fab fa-instagram"></i></a>
                <a href="https://pinterest.com" target="_blank" class="hover:text-red-500"><i class="fab fa-pinterest-p"></i></a>
                <a href="https://youtube.com" target="_blank" class="hover:text-red-600"><i class="fab fa-youtube"></i></a>
            </div>

            <!-- Get in Touch -->
            <div class="text-left md:text-left">
                <h3 class="text-lg font-bold mb-4">Get In Touch</h3>
                <p class="mb-2">Info@moragroup.id</p>
                <p class="mb-2">031 - 359 54 333</p>
                <p>Jalan Arief Rahman Hakim No.187, Surabaya 60111</p>
            </div>

            <!-- Navigation -->
            <div class="grid grid-cols-2 gap-4 text-left md:text-left">
                <div>
                    <h3 class="text-lg font-bold mb-4">Navigate</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Home</a></li>
                        <li><a href="#" class="hover:underline">Property</a></li>
                        <li><a href="#" class="hover:underline">News</a></li>
                        <li><a href="#" class="hover:underline">Project</a></li>
                    </ul>
                </div>
                <div class="mt-[2.3rem] md:mt-16">
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">About us</a></li>
                        <li><a href="#" class="hover:underline">Careers</a></li>
                        <li><a href="#" class="hover:underline">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-12">
            <p>Copyright © 2025 ARUM BROMO VILLAS All Rights Reserved</p>
        </div>
</footer>


<!-- Instalasi Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<script src="https://unpkg.com/lenis@1.1.5/dist/lenis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
    let navbar = document.getElementById("stickyNavbar");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 100) {
            navbar.classList.add("visible-navbar");
            navbar.classList.remove("hidden-navbar");
        } else {
            navbar.classList.remove("visible-navbar");
            navbar.classList.add("hidden-navbar");
        }
    });
    var myCarousel = new bootstrap.Carousel(document.getElementById('carouselExampleCaptions'), {
        interval: 2000,  // Ganti angka ini untuk mengatur durasi antar slide
        ride: 'carousel'
    });
    document.querySelectorAll(".toggle-content").forEach(button => {
        button.addEventListener("click", function () {
            let targetId = this.getAttribute("data-target");
            
            // Sembunyikan semua konten terlebih dahulu
            document.querySelectorAll(".content-section").forEach(section => {
                section.style.display = "none";
            });

            // Tampilkan konten yang sesuai dengan tombol yang diklik
            document.getElementById(targetId).style.display = "block";
        });
    });
</script>
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let q = this.value.toLowerCase();
    let items = document.querySelectorAll('#newsList div.border');
    items.forEach(div => {
        let text = div.innerText.toLowerCase();
        div.style.display = text.includes(q) ? '' : 'none';
    });
});
</script>

<script>
  const toggle = document.getElementById('menu-toggle');
  const menu = document.getElementById('mobile-menu');
  toggle.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
</script>

  
</body>
</html>