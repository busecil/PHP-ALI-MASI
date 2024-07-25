<?php
include "Baglanti.php";
$vt = new Baglanti();
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Formu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post"><!--Login Formu-->
        <div class="container">
            <div class="row" style="padding: 1%">
                <div class="col-md-7 mx-auto">
                    <label for="KullaniciAdi">Kullanıcı Adı:</label>
                    <input type="text" class="form-control" name="KullaniciAdi" placeholder="Kullanıcı Adınızı Giriniz"
                        required maxlength="50" />
                </div>
            </div>


            <div class="row" style="padding: 1%">
                <div class="col-md-7 mx-auto">
                    <label for="Sifre">Şifre:</label>
                    <input type="password" class="form-control" name="Sifre" placeholder="Şifrenizi Giriniz" required
                        maxlength="16" />
                </div>
            </div>


            <div class="row" style="padding: 1%;">
                <div class="col-md-7 mx-auto" style="text-align: right;">
                    <button type="submit" class="btn btn-primary" name="Giris">Giriş</button>
                </div>
            </div>
        </div>
    </form><!--Login Formu-->
    <!--Login İşlemi-->
    <?php
    if (isset($_POST["KullaniciAdi"]) && isset($_POST["Sifre"])) {
        $sonuc = $vt->TekilGetir("select ID from Kullanicilar where KullaniciAdi='" . $_POST["KullaniciAdi"] . "' and Sifre='" . $_POST["Sifre"] . "'");
        if ($sonuc != null) {
            session_start();
            $_SESSION["KullaniciID"] = $sonuc->ID;
            header("location:index.php");
        } else {
            $vt->Bildirim("Kullanıcı adı ve/veya şifre hatalı.");
        }
    }
    ?>
    <!--Login İşlemi-->
</body>
</html>