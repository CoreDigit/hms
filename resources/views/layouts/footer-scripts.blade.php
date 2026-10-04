<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="{{URL::asset('backend/assets/plugins/jquery/jquery.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<!-- Bootstrap Bundle js -->
<script src="{{URL::asset('backend/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('backend/assets/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('backend/assets/plugins/moment/moment.js')}}"></script>

<!-- Rating js-->
<script src="{{URL::asset('backend/assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{URL::asset('backend/assets/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{URL::asset('backend/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{URL::asset('backend/assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
<!--Internal Sparkline js -->
<script src="{{URL::asset('backend/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{URL::asset('backend/assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- right-sidebar js -->
<script src="{{URL::asset('backend/assets/plugins/sidebar/sidebar.js')}}"></script>
<script src="{{URL::asset('backend/assets/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{URL::asset('backend/assets/js/eva-icons.min.js')}}"></script>
@yield('js')
<!-- Sticky js -->
<script src="{{URL::asset('backend/assets/js/sticky.js')}}"></script>
<!-- custom js -->
<script src="{{URL::asset('backend/assets/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{URL::asset('backend/assets/plugins/side-menu/sidemenu.js')}}"></script>

<!-- Global Select2 & Modal Integration Handler -->
<script>
    $(document).ready(function() {
        function initGlobalSelect2(container) {
            var $scope = container ? $(container) : $(document);
            $scope.find('.select2, .select2-show-search, .select2-dropdown, select.SlectBox').each(function() {
                var $select = $(this);
                if ($select.hasClass('select2-hidden-accessible')) {
                    return;
                }
                var $modal = $select.closest('.modal');
                var opts = {
                    width: '100%',
                    placeholder: $select.find('option[disabled][selected]').text() || 'Select option'
                };
                if ($modal.length > 0) {
                    opts.dropdownParent = $modal;
                }
                if (typeof $.fn.select2 === 'function') {
                    $select.select2(opts);
                }
            });
        }

        initGlobalSelect2();

        $(document).on('shown.bs.modal', '.modal', function() {
            initGlobalSelect2(this);
        });

        $(document).on('change', '.select2, .select2-show-search, .select2-dropdown', function() {
            $(this).trigger('blur');
        });
    });
</script>
