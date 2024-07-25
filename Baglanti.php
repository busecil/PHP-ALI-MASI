<?php
class Baglanti
{
    private $sunucuAdi="localhost";
    private $kullaniciAdi="root";
    private $parola="";
    private $veriTabaniAdi="_16221625001VeliAhmedYasinISIK";
    public function Getir($sorgu)
    {
        $baglanti=new mysqli($this->sunucuAdi,$this->kullaniciAdi,$this->parola,$this->veriTabaniAdi);
        if($baglanti->query($sorgu)==true)
        {
            $sonuc=$baglanti->query($sorgu);  
        }
        else
        {
            $this->Bildirim("Hata:".$sorgu."<br>".$baglanti->error);
        }
        mysqli_close($baglanti);
        return $sonuc;
    }
    public function TekilGetir($sorgu)
    {
        $baglanti=new mysqli($this->sunucuAdi,$this->kullaniciAdi,$this->parola,$this->veriTabaniAdi);
        $satir=null;
        if($baglanti->query($sorgu)==true)
        {
            $sonuc=$baglanti->query($sorgu);
            if($sonuc->num_rows>0)
            {
                $satir=$sonuc->fetch_object();
            }
        }
        else
        {
            $this->Bildirim("Hata:".$sorgu."<br>".$baglanti->error);
        }
        mysqli_close($baglanti);
        return $satir;
    }
    public function Ekle($sorgu)
    {
        $baglanti=new mysqli($this->sunucuAdi,$this->kullaniciAdi,$this->parola,$this->veriTabaniAdi);
        if($baglanti->query($sorgu)==true)
        {
            $sonID=$baglanti->insert_id;
            $this->Bildirim("Kayıt Başarıyla Eklendi.");
        }
        else
        {
            $this->Bildirim("Hata:".$sorgu."<br>".$baglanti->error);
        }
        mysqli_close($baglanti);
        return $sonID;
    }
    public function Sil($sorgu)
    {
        $baglanti=new mysqli($this->sunucuAdi,$this->kullaniciAdi,$this->parola,$this->veriTabaniAdi);
        if($baglanti->query($sorgu)==true)
        {
            $this->Bildirim("Kayıt Başarıyla Silindi.");  
        }
        else
        {
            $this->Bildirim("Hata:".$sorgu."<br>".$baglanti->error);
        }
        mysqli_close($baglanti);
    }
    public function Guncelle($sorgu)
    {
        $baglanti=new mysqli($this->sunucuAdi,$this->kullaniciAdi,$this->parola,$this->veriTabaniAdi);
        if($baglanti->query($sorgu)==true)
        {
            $this->Bildirim("Kayıt Başarıyla Güncellendi.");  
        }
        else
        {
            $this->Bildirim("Hata:".$sorgu."<br>".$baglanti->error);
        }
        mysqli_close($baglanti);
    }
    public function Bildirim($mesaj)
    {
        echo "<script type='text/javascript'>alert('$mesaj');</script>";
    }
    public function Sayfala($sorgu,$bas,$kayitSayisi)
      {
        try
        {
          $baglanti=new mysqli($this->sunucuAdi,$this->kullaniciAdi,$this->parola,$this->veriTabaniAdi);
          $sorgu.=" limit $bas, $kayitSayisi";
          if($baglanti->query($sorgu)==true)
          {
              $sonuc=$baglanti->query($sorgu);
          }
          else
          {
            $this->Bildirim("Hata:".$sorgu."<br>".$baglanti->error);
          }
          mysqli_close($baglanti);
          return $sonuc;
        }
        catch(Exception $e)
        {
          $this->Bildirim("Hata:".$e->getMessage());
        }
      }
}
?>