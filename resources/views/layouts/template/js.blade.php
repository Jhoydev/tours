
<script src="{{ mix('js/main.js') }}"></script>
<script src="/template/vendors/js/vendor.bundle.base.js"></script>
<script src="/template/vendors/js/vendor.bundle.addons.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/es.js"></script>
<script src="/template/js/off-canvas.js"></script>
<script src="/template/js/hoverable-collapse.js"></script>
<script src="/template/js/misc.js"></script>
<script src="/template/js/settings.js"></script>
<script src="/template/js/todolist.js"></script>
<script src="/template/js/dashboard.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
    $('[data-toggle="tooltip"]').tooltip();
</script>

@yield('script')
@stack('scripts')