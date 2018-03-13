@extends('master')
@section('content')
<section>
  <img class="mySlides w3-animate-left" src="image/magasin Resized.jpg">
  <img class="mySlides w3-animate-left" src="image/voiture Resized.jpg">
</section>
<article>
  <!-- @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="text-danger error">{{ $error }}</div>
    @endforeach
  @endif -->
</article>

<section class='d-flex flex-wrap justify-content-around align-items-center connexion'>

  <form class="d-flex flex-column col-10 col-md-4 card" action="{!! URL::route('utilisateur.connexion') !!}" method="post">
    {{csrf_field()}}
    <input class='is-valid form-control' type="text" name="pseudoConnexion" placeholder="entrez votre nom" value="{{old('pseudoConnexion')}}">
    {!!$errors->first('pseudoConnexion', '<span class="error-msg ">
        :message
      </span>')!!}
    <input type="password" name="passwordConnexion" placeholder="entrez votre mot de passe" value="{{old('passwordConnexion')}}">
    {!!$errors->first('passwordConnexion', '<span class="error-msg ">
        :message
      </span>')!!}
    <input class='btn validation' type="submit" name="connexion" value="connexion">
  </form>

  <form class="mt-2 d-flex flex-column col-10 col-md-4 card" action="{!! URL::route('utilisateur.createUser') !!}" method="post">
    {{csrf_field()}}
    <input type="text" name="pseudoCreation" placeholder="donnez un nom" value="{{old('pseudoCreation')}}">
    {!!$errors->first('pseudoCreation', '<span class="error-msg ">
        :message
      </span>')!!}
    <input type="password" name="passwordCreation" placeholder="rentrez un mot de passe" value="{{old('passwordCreation')}}">
    {!!$errors->first('pseudoCreation', '<span class="error-msg ">
        :message
      </span>')!!}
    <input type="text" name="mailCreation" placeholder="rentrez votre adresse mail" value="{{old('mailCreation')}}">
    {!!$errors->first('mailCreation', '<span class="error-msg ">
        :message
      </span>')!!}
    <input class='btn validation' type="submit" name="" value="creer compte">
  </form>

</section>
<script type="text/javascript">
if (window.location.href == '{!! URL::route('utilisateur.connexionPage') !!}' || window.location.href == '{!! URL::route('utilisateur.returnConnexionPage') !!}' ) {
  if (window.matchMedia("(max-width: 1024px)").matches) {
    $(document).ready(function(){
      $(".mySlides").hide();
    });
  }
  else {
    $(document).ready(function(){
      carousel();
    });
  }
}
</script>
@stop
