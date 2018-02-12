@extends('master')

@section('content')
{!!$errors->first('newMoney', '<p class="error-msg text-center error">
    :message
  </p>')!!}
{!!$errors->first('moneyForOther', '<p class="error-msg text-center error">
      :message
    </p>')!!}
{!!$errors->first('nameUser', '<p class="error-msg text-center error">
    :message
  </p>')!!}
@if(session('error'))
  <p class='text-center error'>{{session('error')}}</p>
  <?php Session::forget('error');  ?>
@endif
<section>
  <article class="text-center">
    <h5>{{$compte->type_account}}</h5>
    <p>{{$compte->owner}}</p>
    <p>reserve : {{$compte->credit}}</p>
  </article>
  <section class='d-flex justify-content-around flex-wrap'>

    <!-- effacer compte courant -->
    <form class="m-2 text-center p-4 bg-faded" action="http://localhost:8888/siteBanqueLaravel/public/detailCompte/effacerCompte" method="post">
      {{csrf_field()}}
      <input class='d-none' type="text" name="idCompte" value="{{$compte->id}}">
      <label for="">êtes vous sûr de vouloir supprimer ce comptes?</label><br>
      <label for="">oui :</label>
      <input type="checkbox" name="validationDelete" value="oui"><br>
      <input type="submit" name="" value="Effacer">
    </form>

    <!-- Ajouter Argent compte Courant -->
    <form class="m-2 text-center p-4 bg-faded" action="http://localhost:8888/siteBanqueLaravel/public/detailCompte/ajoutArgent" method="post">
      {{csrf_field()}}
      <input class='d-none' type="text" name="idCompte" value="{{$compte->id}}">
      <input type="text" name="newMoney" value=""><br>
      <input type="submit" name="" value="Ajouter Argent">
    </form>

    <!-- Transfert Argent à un de ses comptes -->
    <form class="m-2 text-center p-4 bg-faded" action="http://localhost:8888/siteBanqueLaravel/public/detailCompte/transfertSoi" method="post">
      <input class='d-none' type="text" name="idCompte" value="{{$compte->id}}">
      <label for="">Compte :</label>
      <select class="" name="idDestinataire">
        @foreach($otherSelfComptes as $otherSelfCompte => $value)
          <option value="{{$value->id}}">{{$value->type_account}}</option>
        @endforeach
      </select><br>
      <input type="text" name="moneyForMe" value=""><br>
      <input type="submit" name="forMe" value="Transferer Argent">
      {{csrf_field()}}
    </form>

    <!-- Créer lien entre ce compte et un utilisateur -->
    <form class="" action="http://localhost:8888/siteBanqueLaravel/public/detailCompte/linkAccount" method="post">
      {{csrf_field()}}
      <input class='d-none' type="text" name="idCompte" value="{{$compte->id}}"><br>
      <input class='d-none' type="text" name="owner" value="{{$compte->owner}}"><br>
      <input type="text" name="nameUser" value=""><br>
      <input type="submit" name="" value="Se connecter à l'utilisateur"><br>
    </form>

    <!-- Transfert Argent vers un compte tier -->
    <form class="m-2 text-center p-4 bg-faded" action="http://localhost:8888/siteBanqueLaravel/public/detailCompte/TransfertAutre" method="post">
      {{csrf_field()}}
      <input class='d-none' type="text" name="idCompte" value="{{$compte->id}}">
      <label for="">compte :</label>
      <select class="" name="idDestinataire">
        @if(session('trouve'))
        <?php Session::forget('trouve');
        $otherComptes = session('otherComptes');
        Session::forget('otherComptes');  ?>
          @foreach($otherComptes as $otherCompte => $value)
            <option value="{{$value->id}}">{{$value->owner}}:{{$value->type_account}}</option>
          @endforeach
        @endif
      </select><br>
      <input type="text" name="moneyForOther" value=""><br>
      <input type="submit" name="forOther" value="Transferer Argent">
    </form>
  </section>
</section>
<a class='btn btn-primary m-3' href="http://localhost:8888/siteBanqueLaravel/public/indexComptes">retour index</a>
@stop
