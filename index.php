<?php
include "Baglanti.php";
$vt = new Baglanti();
session_start();
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Anasayfa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
</head>

<body>
  <?php
  if (isset($_GET["ID"])) {
    $vt->Sil("delete from 001PHP where ID =" . $_GET["ID"]);
    header("Location:index.php");
  }
  $ID = -1;
  $adi = "";
  $soyadi = "";
  $DogumTarihi = "01.01.1990";
  $Yas = "0";


  if (isset($_GET["DuzenID"])) {
    $sonuc = $vt->TekilGetir("select * from 001PHP where ID =" . $_GET["DuzenID"] . "");
    $ID = $sonuc->ID;
    $adi = $sonuc->Ad;
    $soyadi = $sonuc->SoyAd;
    $Yas = $sonuc->Yas;
    $DogumTarihi = $sonuc->DogumTarihi;
  }
  if(isset($_POST["Cikis"]))
  {
    session_destroy();
    header("Location:login.php");
  }
  ?>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post"><!--Bilgi Girişi-->
    <div class="container">
        <?php
        if(isset($_SESSION["KullaniciID"]))
        {
            $satir=$vt->TekilGetir("select KullaniciAdi from Kullanicilar where ID=".$_SESSION["KullaniciID"]."");
            echo "<div class=\"row\" style=\"padding: 1%\">
        <div class=\"col-md-7 mx-auto\">
        <label for=\"kadi\">$satir->KullaniciAdi</label>
        <button type=\"submit\" class=\"btn btn-primary\" name=\"Cikis\">Çıkış</button>
        </div>
        </div>";
        }
        else
        {
            header("location:login.php");
        }
        ?>
      <div class="row" style="padding: 1%">
        <div class="col-md-7 mx-auto">
          <input type="hidden" name="ID" value="<?php echo $ID ?>">
          <label for="adi">Adı</label>
          <input type="text" class="form-control" id="adi" name="adi" placeholder="Adınızı Giriniz"
            value="<?php echo $adi ?>" />
        </div>
      </div>

      <div class="row" style="padding: 1%">
        <div class="col-md-7 mx-auto">
          <label for="soyadi">Soyadı</label>
          <input type="text" class="form-control" id="soyadi" name="soyadi" placeholder="Soyadınızı Giriniz"
            value="<?php echo $soyadi ?>" />
        </div>
      </div>


      <div class="row" style="padding:1%;">
        <div class="col-md-7 mx-auto">
          <div data-mdb-input-init class="form-outline">
            <label calss="form-label" for="Yas">Yaşı</label>
            <input type="number" id="Yas" name="Yas" class="form-control" placeholder="Yaşınızı Giriniz"
              value="<?php echo $Yas ?>" />

          </div>
        </div>
      </div>
      <div class="row" style="padding:1%;">
        <div class="col-md-7 mx-auto">
          <div data-mdb-input-init class="form-outline">
            <label calss="form-label" for="DogumTarihi">Doğum Tarihi</label>
            <input type="date" id="DogumTarihi" name="DogumTarihi" class="form-control"
              placeholder="Doğum Tarihinizi Giriniz" value="<?php echo $DogumTarihi ?>" />

          </div>
        </div>
      </div>
      <div class="row" style="padding: 1%;">
        <div class="col-md-7 mx-auto" style="text-align: right;">
          <button type="submit" class="btn btn-primary" name="Kaydet">Kaydet</button>
        </div>
      </div>
    </div>

  </form>
  <!--Bilgi Girişi-->
  <?php
  if (isset($_POST["Kaydet"]) && $_POST["ID"] == -1) {
    if ($_POST["adi"] != "" && $_POST["soyadi"] != "" && $_POST["Yas"] != "" && $_POST["DogumTarihi"] != "") {
      $vt->Ekle("insert into 001PHP (Ad,SoyAd,Yas,DogumTarihi) values('" . $_POST["adi"] . "','" . $_POST["soyadi"] . "','" 
      . $_POST["Yas"] . "','" . $_POST["DogumTarihi"] . "')");
    } else {
      $vt->Bildirim("Boş Kayıt Eklenemez.");
    }
  } else if (isset($_POST["Kaydet"]) && $_POST["ID"] != -1) {
    if ($_POST["adi"] != "" && $_POST["soyadi"] != "" && $_POST["Yas"] != "" && $_POST["DogumTarihi"] != "") {
      $vt->Guncelle("update 001PHP set Ad='" . $_POST["adi"] . "',Soyad='" . $_POST["soyadi"] . "',Yas='" . $_POST["Yas"] 
      . "',DogumTarihi='" . $_POST["DogumTarihi"] . "' where ID='" . $_POST["ID"] . "'");
    } else {
      $vt->Bildirim("Boş Kayıt Güncellenemez.");
    }

  }
  ?>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post"><!--Arama Kısmı-->
    <div class="container">
      <div class="row" style="padding: 1%">
        <div class="col-md-7 mx-auto">
          <label for="aranan">Ara</label>
          <input type="text" class="form-control" id="aranan" name="aranan" placeholder="Ara" />
        </div>
      </div>
      <div class="row" style="padding: 1%;">
        <div class="col-md-7 mx-auto" style="text-align: right;">
          <button type="submit" class="btn btn-success">Ara</button>
        </div>
      </div>
    </div>
  </form> <!--Arama Kısmı-->
  <!--Sayfalama Kısmı-->
  <?php
  $bas = 0;
  $sayfadakiKayitSayisi = 4;
  $aktifSayfa;
  $aranan;
  if (isset($_GET["aktifSayfa"])) {
    $aktifSayfa = $_GET["aktifSayfa"];
  } else {
    $aktifSayfa = 1;
  }
  $sayfaSayisi = ceil($vt->Getir("select ID from 001PHP")->num_rows / $sayfadakiKayitSayisi);
  $bas = ((int) $aktifSayfa - 1) * $sayfadakiKayitSayisi;
  ?>
  <!--Sayfalama Kısmı-->


  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post"><!--Veri Listeleme Kısmı-->
    <div class="container">
      <div class="row" style="padding: 1%;">
        <div class="col-md-10 mx-auto">
          <table class="table table-hover table-dark">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Adı</th>
                <th scope="col">Soyadı</th>
                <th scope="col">Yaşı</th>
                <th scope="col">Doğum Tarihi</th>
                <th scope="col">İşlem</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_POST["aranan"])) {
                $sonuc = $vt->Getir("select * from 001PHP where Ad like'%" . $_POST["aranan"] . "%' or SoyAd like'%" . $_POST["aranan"] . "%'");
              } else {
                $sonuc = $vt->Sayfala("select * from 001PHP",$bas,$sayfadakiKayitSayisi);
              }
              if ($sonuc->num_rows > 0) {
                while ($satir = $sonuc->fetch_object()) {
                  echo "<tr><th scope=\"row\"> $satir->ID</th>
                  <td>$satir->Ad</td>
                  <td>$satir->SoyAd</td>
                  <td>$satir->Yas</td>
                  <td>$satir->DogumTarihi</td>
                  <td>
                  <a href=\"index.php?DuzenID=$satir->ID&aktifSayfa=$aktifSayfa\" class=\"btn btn-primary\">Düzenle</a>
            <a href=\"index.php?ID=$satir->ID\" class=\"btn btn-danger\">Sil</a></td></tr>";
                }
              } else {
                echo "<td colspan=\"4\">Kayıt bulunamadı</td></tr>";
              }
              ?>
              <!--<tr>
            <th scope="row">1</th>
            <td>Ali</td>
            <td>Veli</td>
            <td>
              <a href="index.php?DuzenID=1" class="btn btn-primary">Düzenle</a>
              <a href="index.php?ID=1" class="btn btn-danger">Sil</a>
            </td>
          </tr>-->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </form> <!--Veri Listeleme Kısmı-->
  <!--Sayfalama Kısmı-->
  <div class="container">
    <div class="row" style="padding:1%">
      <div class="col-md-10 mx-auto">
        <nav aria-label="...">
          <?php
            if (!isset($_POST["aranan"])||$_POST["aranan"]=="")
            {
              if ($aktifSayfa==1&&$sonuc->num_rows>0)
              {
                echo "<ul class=\"pagination justify-content-center\">
                <li class=\"page-item disabled\">
                <span class=\"page-link\">İlk</span>
                </li>
                <li class=\"page-item disabled\">
                <a class=\"page-link\">Önceki</a>
                </li>";
              }
              else if ($sonuc->num_rows>0)
              {
                echo "<ul class=\"pagination justify-content-center\">
                <li class=\"page-item\">
                <a class=\"page-link\" href=\"index.php\">İlk</a>
                </li>
                <li class=\"page-item\">
                <a class=\"page-link\" href=\"index.php?aktifSayfa=".((int)$aktifSayfa-1)."\">Önceki</a>
                </li>";
              }
              for ($i= 1; $i<=$sayfaSayisi; $i++)
              {
                if($i==$aktifSayfa)
                {
                  echo "<li class=\"page-item active\">
                  <span class=\"page-link\">$i</span>
                  <span class=\"sr-only\">(current)</span> 
                  </li>";
                }
                else
                {
                  echo "<li class=\"page-item\">
                  <a class=\"page-link\" href=\"index.php?aktifSayfa=".$i."\">$i</a>
                  </li>";
                }
              }
              if ($aktifSayfa==$sayfaSayisi&&$sonuc->num_rows>0)
              {
                echo "<ul class=\"pagination justify-content-center\">
                <li class=\"page-item disabled\">
                <span class=\"page-link\">Sonraki</span>
                </li>
                <li class=\"page-item disabled\">
                <span class=\"page-link\">Son</span>
                </li>";
              }
              else if ($sonuc->num_rows>0)
              {
                echo "<ul class=\"pagination justify-content-center\">
                <li class=\"page-item\">
                <a class=\"page-link\" href=\"index.php?aktifSayfa=".((int)$aktifSayfa+1)."\">Sonraki</a>
                </li>
                <li class=\"page-item\">
                <a class=\"page-link\" href=\"index.php?aktifSayfa=".$sayfaSayisi."\">Son</a>
                </li>";
              }
            }
          ?>
        </nav>
      </div>
    </div>
  </div>
  <!--Sayfalama Kısmı-->
</body>

</html>