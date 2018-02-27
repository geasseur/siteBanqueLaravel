@extends('master')

@section('header')
<section class='d-flex justify-content-between align-items-center flex-wrap col-10 m-auto'>
  <form class="d-flex flex-column justify-content-around align-items-center m-auto" action="{!! URL::route('compte.createAccount') !!}" method="post">
    {{csrf_field()}}
    <label for="mb-2">type de compte :</label>
    <select class="mb-2" name="typeCompte">
      <option value="livretA">Livret A</option>
      <option value="livret+">livret +</option>
      <option value="CompteEtudiant">Compte Etudiant</option>
    </select><br>
    <input class='d-none' type="text" name="idUser" value="{{session('idUser')}}"><br>
    <input class='btn validation' type="submit" name="" value="creer compte">
  </form>
  <form class="m-auto" action="{!! URL::route('utilisateur.returnConnexionPage') !!}" method="post">
    {{csrf_field()}}
    <input class='btn validation' type="submit" name="" value="Deconnexion">
  </form>
</section>
@stop

@section('content')
<h3 class='text-center mb-3'>Vos comptes</h3>
<section class='d-flex flex-wrap justify-content-around'>
    @if($comptes)
      @foreach($comptes as $compte)
        <article class="card p-5 text-center m-3 compteIndex @if($compte->credit < 0)
          bg-danger
        @else
          bg-success
        @endif">
          <h5>{{$compte->type_account}}</h5>
          <p>{{$compte->owner}}</p>
          <label for="">Reserve :</label>
          <p class='creditIndex'>{{$compte->credit}}</p>

          <!-- Voir detail Compte -->
          <form class="" action="{!! URL::route('compte.detailPage') !!}" method="post">
            {{csrf_field()}}
            <input type="text" class='d-none' name="idCompte" value="{{$compte->id}}">
            <input type="submit" class='btn validation' name="" value="detail compte">
          </form>
        </article>
      @endforeach
    @endif
</section>
@stop
