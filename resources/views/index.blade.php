@extends('master')

@section('header')
<section class='d-flex justify-content-between align-items-center'>
  <form class="d-flex flex-column justify-content-around align-items-center m-3 col-2" action="http://localhost:8888/siteBanqueLaravel/public/indexComptes/creationCompte" method="post">
    @if(session('error'))
      <p class='text-center'>{{session('error')}}</p>
      <?php Session::forget('error');  ?>
    @endif
    {{csrf_field()}}
    <label for="mb-2">type de compte :</label>
    <select class="mb-2" name="typeCompte">
      <option value="livretA">Livret A</option>
      <option value="livret+">livret +</option>
      <option value="CompteEtudiant">Compte Etudiant</option>
    </select><br>
    <input type="text" name="idUser" value="{{session('idUser')}}"><br>
    <input type="submit" name="" value="creer compte">
  </form>
  <form class="mr-5" action="http://localhost:8888/siteBanqueLaravel/public/" method="post">
    {{csrf_field()}}
    <input type="submit" name="" value="Deconnexion">
  </form>
</section>
@stop

@section('content')
<h3 class='text-center mb-3'>Vos comptes</h3>
<section class='d-flex flex-wrap justify-content-around'>
    @if($comptes)
      @foreach($comptes as $compte)
        <article class="card p-5 text-center">
          <h5>{{$compte->type_account}}</h5>
          <p>{{$compte->owner}}</p>
          <p>reserve : {{$compte->credit}}</p>
          <form class="" action="" method="post">
            {{csrf_field()}}
            <input type="text" class='d-none' name="idCompte" value="{{$compte->id}}">
            <input type="submit" class='btn' name="" value="detail compte">
          </form>
          <!-- Effacement du compte -->
          <form class="mt-2" action="http://localhost:8888/siteBanqueLaravel/public/effacerCompte" method="post">
            {{csrf_field()}}
            <input class='d-non' type="text" name="idCompte" value="{{$compte->id}}">
            <input type="submit" class='btn' name="" value="supprimer">
          </form>
        </article>
      @endforeach
    @endif
</section>
@stop
