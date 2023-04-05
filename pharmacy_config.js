$(document).ready(function() {
    $('PharmaciesDataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'datatable',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'Pharmacy Name', name: 'name' },
            { data: 'Owner Email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
        ]
    });
});
