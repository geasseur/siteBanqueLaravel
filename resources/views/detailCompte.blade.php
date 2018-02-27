@extends('master')

@section('content')
<!-- {!!$errors->first('newMoney', '<p class="error-msg text-center error">
    :message
  </p>')!!}
{!!$errors->first('moneyForOther', '<p class="error-msg text-center error">
      :message
    </p>')!!}
{!!$errors->first('idDestinataire', '<p class="error-msg text-center error">
          :message
  </p>')!!}
{!!$errors->first('nameUser', '<p class="error-msg text-center error">
    :message
  </p>')!!}
{!!$errors->first('moneyForMe', '<p class="error-msg text-center error">
    :message
  </p>')!!} -->
<section>
  <article class="text-center col-5 m-auto
  @if($compte->credit < 0)
    bg-danger
  @else
    bg-success
  @endif">
    <h5>Détail Compte</h5>
    <h5>{{$compte->type_account}}</h5>
    <p>{{$compte->owner}}</p>
    <p>{{$compte->credit}}</p>
  </article>
  <section class='d-flex justify-content-around flex-wrap'>

    <!-- Ajouter Argent compte Courant -->
    <form class="m-2 text-center p-4 card d-flex flex-column justify-content-around col-10 col-md-5 col-lg-3" action="{!! URL::route('compte.addMoney') !!}" method="post">
      <h5>Effectuer un dépot</h5>
      {{csrf_field()}}
      <label for="">Sommes à déposer :</label>
      <input class='d-none' type="text" name="idCompte" value="{{$compte->id}}">
      <input placeholder="montant en chiffres" type="text" name="newMoney" value=""><br>
      <input class='btn validation' type="submit" name="" value="effectuer depot">
    </form>

    <!-- Transfert Argent à un de ses comptes -->
    <form class="m-2 text-center p-4 card col-10 col-md-5 col-lg-3" action="{!! URL::route('compte.transfertSoi') !!}" method="post">
      <h5>Virement à un des ses comptes</h5>
      <input class='d-none' type="text" name="idCompte" value="{{$compte->id}}">
      <label for="">Compte :</label>
      <select class="" name="idDestinataire">
        @foreach($otherSelfComptes as $otherSelfCompte => $value)
          <option value="{{$value->id}}">{{$value->type_account}}</option>
        @endforeach
      </select><br>
      <input placeholder="montant en chiffres" type="text" name="moneyForMe" value=""><br>
      <input class='btn validation' type="submit" name="forMe" value="Virement">
      {{csrf_field()}}
    </form>

    <!-- Créer lien entre ce compte et un utilisateur -->
    <form class="m-2 text-center card p-4 col-10 col-md-5 col-lg-3" action="{!! URL::route('compte.newLink') !!}" method="post">
      {{csrf_field()}}
      <h5>recherche d'un destinataire</h5>
      <input class='d-none' type="text" name="idCompte" value="{{$compte->id}}"><br>
      <input class='d-none' type="text" name="owner" value="{{$compte->owner}}"><br>
      <input placeholder="nom recherché" type="text" name="nameUser" value=""><br>
      <input class='btn validation' type="submit" name="" value="trouver Destinataire"><br>
    </form>

    <!-- Transfert Argent vers un compte tier -->
    <form class="m-2 text-center p-4 card col-10 col-md-5 col-lg-3" action="{!! URL::route('compte.transfertOtherMoney') !!}" method="post">
      {{csrf_field()}}
      <h5>Virement à un compte tier</h5>
      <input class='d-none' type="text" name="idCompte" value="{{$compte->id}}">
      <label for="">compte :</label>
      <select class="" name="idDestinataire">
        @if(session('otherComptes'))
        <?php
        $otherComptes = session('otherComptes');?>
          @foreach($otherComptes as $otherCompte => $value)
            <option value="{{$value->id}}">{{$value->owner}}:{{$value->type_account}}</option>
          @endforeach
        @endif
      </select><br>
      <input placeholder="montant en chiffres" type="text" name="moneyForOther" value=""><br>
      <input class='btn validation' type="submit" name="forOther" value="effectuer Virement">
    </form>

  </section>
</section>
<a class='btn validation col-6 col-md-2 m-3 retour' href="{!! URL::route('compte.indexComptesGet') !!}">retour index</a>
@stop

@section('footer')
<!-- effacer compte courant -->
<form class="bg-danger m-auto text-center p-4 card col-10 col-md-5 col-lg-3" action="{!! URL::route('compte.deleteAccountDetail') !!}" method="post">
  {{csrf_field()}}
  <h5>suppression du compte</h5>
  <input class='d-none' type="text" name="idCompte" value="{{$compte->id}}">
  <label for="">êtes vous sûr de vouloir <br> supprimer ce comptes? :</label><br>
  <label for="">oui :</label>
  <input class='m-auto' type="checkbox" name="validationDelete" value="oui">
  <input class='btn validation' type="submit" name="" value="Effacer le compte">
</form>
@stop
