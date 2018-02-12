@extends('master')

@section('header')
<section class='d-flex justify-content-between align-items-center'>
  <form class="d-flex flex-column justify-content-around align-items-center ml-2" action="http://localhost:8888/siteBanqueLaravel/public/indexComptes/creationCompte" method="post">
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
  <form class="mr-4" action="http://localhost:8888/siteBanqueLaravel/public/" method="post">
    {{csrf_field()}}
    <input type="submit" name="" value="Deconnexion">
  </form>
</section>
@stop

@section('content')
@if(session('error'))
  <p class='text-center error'>{{session('error')}}</p>
  <?php Session::forget('error');  ?>
@endif
<h3 class='text-center mb-3'>Vos comptes</h3>
<section class='d-flex flex-wrap justify-content-around'>
    @if($comptes)
      @foreach($comptes as $compte)
        <article class="card p-5 text-center m-3">
          <h5>{{$compte->type_account}}</h5>
          <p>{{$compte->owner}}</p>
          <p>reserve : {{$compte->credit}}</p>

          <!-- Voir detail Compte -->
          <form class="" action="http://localhost:8888/siteBanqueLaravel/public/detailCompte" method="post">
            {{csrf_field()}}
            <input type="text" class='d-none' name="idCompte" value="{{$compte->id}}">
            <input type="submit" class='btn' name="" value="detail compte">
          </form>
        </article>
      @endforeach
    @endif
</section>
@stop
