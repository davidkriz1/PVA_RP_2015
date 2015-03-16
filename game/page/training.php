<div class="trainingheaddiv">
</div>
<form action="" method="post" autocomplete="off">
<div class="trainingdiv">
  <div class="trainingtypediv">
    <div class="trainingtypedescdiv">
      <div class="trainingtypetitlediv">
        Tvá aktuální síla:
        <?php
        $playerdataassoc = playerdatafunction($link);     
        $strength = $playerdataassoc["strength"];
        $dexterity = $playerdataassoc["dexterity"];
        $stamina = $playerdataassoc["stamina"];

        $coststrength = $strength * 30;
        $costdexterity = $dexterity * 30;      
        $coststamina = $stamina * 30;
      
        echo($strength);
        ?>
      </div>
      <div class="trainingtypedescriptiondiv">
        Síla zvyšuje vaše poškození způsobené zbraněmi
      </div>
    </div>
    <div class="currencydiv">
      <div class="currencyimagediv">
        <img src="http://home.spsostrov.cz/~krizda/php/Images/gold.png" class="currencyimage">
      </div>
        <span class="goldcurrencyvaluespan">
          <?php
          echo($coststrength);
          ?>
        </span>
    </div>
  </div>
  <div class="trainingbuttondiv">  
    <input type="submit" name="trainingstrength" class="trainingbutton" value="">
  </div>
</div>
<div class="trainingdiv">
  <div class="trainingtypediv">
    <div class="trainingtypedescdiv">
      <div class="trainingtypetitlediv">
        Tvá aktuální obratnost:
        <?php
        echo($dexterity);
        ?>
      </div>
      <div class="trainingtypedescriptiondiv">
        Obratnost zvyšuje vaši obranu
      </div>
    </div>
    <div class="currencydiv">
      <div class="currencyimagediv">
        <img src="http://home.spsostrov.cz/~krizda/php/Images/gold.png" class="currencyimage">
      </div>
        <span class="goldcurrencyvaluespan">
        <?php
        echo($costdexterity);      
        ?>
        </span>
    </div>
  </div>
  <div class="trainingbuttondiv"> 
    <input type="submit" name="trainingstdexterity" class="trainingbutton" value="">
  </div>
</div>
<div class="trainingdiv">
  <div class="trainingtypediv">
    <div class="trainingtypedescdiv">
      <div class="trainingtypetitlediv">
      Tvá aktuální odolnost:
      <?php
      echo($stamina);
      ?>
      </div>
      <div class="trainingtypedescriptiondiv">
        Odolnost zvyšuje vaše body života
      </div>
    </div>
    <div class="currencydiv">
      <div class="currencyimagediv">
        <img src="http://home.spsostrov.cz/~krizda/php/Images/gold.png" class="currencyimage">
      </div>
        <span class="goldcurrencyvaluespan">
          <?php
          echo($coststamina);
          ?>
        </span>
    </div>
  </div>
  <div class="trainingbuttondiv">  
    <input type="submit" name="trainingstamina" class="trainingbutton" value="">
  </div>
</div>
</form>