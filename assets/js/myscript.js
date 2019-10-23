const flashData = $('.flash-data').data('flashdata');

if( flashData){
    Swal.fire({
        title: 'Data Mahasiswa',
        text: 'Berhasil' + flashData,
        type: 'success'
    });
}