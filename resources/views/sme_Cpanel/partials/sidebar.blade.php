<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ url('/index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-navk" data-bs-toggle="collapse" href="#">
                <i class="fas fa-fw fa-home"></i><span>Home</span>
            </a>
            <ul id="icons-navk" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ url('dynamic/sme_Cpanel/why') }}">
                        <i class="fas fa-fw fa-question-circle"></i><span>Why Choose Us</span>

                    </a>
                </li>

                <li>
                    <a href="{{ url('dynamic/sme_Cpanel/home_feature') }}">
                        <i class="fas fa-fw fa-star"></i><span>Feature</span>

                    </a>
                </li>

                <li>
                    <a href="{{ url('dynamic/sme_Cpanel/home_testimonial') }}">
                        <i class="fas fa-fw fa-quote-right"></i><span>Testimonials</span>

                    </a>
                </li>

            </ul>
        </li><!-- End Home Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('dynamic/sme_Cpanel/about') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>About Us</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('dynamic/sme_Cpanel/founder') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Founders</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-navv" data-bs-toggle="collapse" href="#">
                <i class="fa fa-wrench"></i><span>Service</span>
            </a>
            <ul id="icons-navv" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ url('dynamic/sme_Cpanel/corporate_hire') }}">
                        <i class="fas fa-building"></i><span>Corporate Hire</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('dynamic/sme_Cpanel/employee_transportation') }}">
                        <i class="fas fa-bus"></i><span>Employee Transportation</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('dynamic/sme_Cpanel/fleet_management') }}">
                        <i class="fas fa-truck"></i><span>Fleet Management</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Service Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('/dynamic/sme_Cpanel/our-solution') }}">
                <i class="fas fa-fw fa-lightbulb"></i>
                <span>Our Solution</span>
            </a>
        </li><!-- End Blank Page Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('dynamic/sme_Cpanel/fleet') }}">
                <i class="fas fa-fw fa-car"></i>
                <span>Fleet</span>
            </a>
        </li><!-- End Blank Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('dynamic/sme_Cpanel/contact') }}">
                <i class="fas fa-fw fa-phone"></i>
                <span>Contact</span>
            </a>
        </li><!--

        <--End Blank Page Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('dynamic/sme_Cpanel/contact-enquiry') }}">
                <i class="fas fa-fw fa-envelope"></i>
                <span>Contact Enquiry</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('#sidebar');
    const sidebarLinks = document.querySelectorAll('#sidebar-nav .nav-link');
    const body = document.body;

    // Close sidebar on link click for small screens
    sidebarLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 992) {
                sidebar.classList.add('hidden-sidebar');
                body.classList.add('toggle-sidebar');
            }
        });
    });
});
</script>
@endpush

