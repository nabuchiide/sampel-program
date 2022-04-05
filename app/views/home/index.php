<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <?php
    $dataUser = $data['user'];
    ?>
    <hr>
    <?php Flasher::flash(); ?>
    <h1>INPUT DATA KE TABEL USER</h1>
    <form action="<?= BASEURL; ?>/home/tambah" method="post" class="form-enter" onsubmit="" id="formInsertData">
        <label for="nama">First name:</label><br>
        <input type="hidden" id="id" name="id"><br>
        <input type="text" id="nama" name="nama"><br>
        <label for="email">Last name:</label><br>
        <input type="text" id="email" name="email"><br><br>
        <label for="level">Level:</label><br>
        <select id="level" name="level">
            <option value="1">Super User</option>
            <option value="2">User</option>
        </select><br><br>
        <button type="submit" class="submitForm">Simpan Data</button>
    </form>
    <hr>
    <h1>TAMPIL SEMUA DATA</h1>
    <table border="1">
        <tr>
            <th>no</th>
            <th>nama</th>
            <th>email</th>
            <th>level</th>
            <th></th>
        </tr>
        <tbody>
            <?php $no = 0;
            foreach ($dataUser as $user) :
                $no++ ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $user['nama']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['level']; ?></td>
                    <td>
                        <button class="getUbah" data-id="<?= $user['id']; ?>">
                            <span>Ubah</span>
                        </button>
                        <button class="hapusData" data-id="<?= $user['id']; ?>">
                            <span>Hapus</span>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <script>
        $(document).ready(function() {

            $('.getUbah').on('click', function() {
                const id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: '<?= BASEURL; ?>/user/getUbah/',
                    data: {
                        id: id
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        $('#id').val(result.id);
                        $('#nama').val(result.nama);
                        $('#email').val(result.email);
                        $('#level').val(result.level);
                        $('#formInsertData').attr('action', '<?= BASEURL; ?>/home/ubah')
                        $('#formInsertData .submitForm').html('Ubah Data')
                    },
                    error: function() {
                        alert("ERROR RESULT")
                    }
                })
            })

            $('.hapusData').on('click', function() {
                const id = $(this).data('id');
                console.log(id);
                var dataConfirmation = confirm("Apakah Anda yakin ingin menghapus data ini?")
                if (dataConfirmation) {
                    $.ajax({
                        url: '<?= BASEURL; ?>/user/setHapus/',
                        data: {
                            id: id
                        },
                        method: 'post',
                        success: function(result) {
                           location.reload()
                        },
                        error: function() {
                            alert("ERROR RESULT")
                        }
                    })
                }
            })

        })
    </script>
</body>

</html>