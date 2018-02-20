@extends('master')
@section('content')
<section>
  <img class="mySlides w3-animate-left" src="image/magasin Resized.jpg">
  <img class="mySlides w3-animate-left" src="image/voiture Resized.jpg">
</section>
<article>
  {!!$errors->first('pseudoConnexion', '<p class="error-msg text-center error">
      :message
    </p>')!!}
  {!!$errors->first('passwordConnexion', '<p class="error-msg text-center error">
      :message
    </p>')!!}
    {!!$errors->first('pseudoCreation', '<p class="error-msg text-center error">
        :message
      </p>')!!}
    {!!$errors->first('passwordCreation', '<p class="error-msg text-center error">
        :message
      </p>')!!}
    {!!$errors->first('mailCreation', '<p class="error-msg text-center error">
          :message
        </p>')!!}
</article>

<section class='d-flex flex-wrap justify-content-around align-items-center connexion'>

  <form class="d-flex flex-column col-10 col-md-4 card" action="http://localhost:8888/siteBanqueLaravel/public/testConnexion" method="post">
    {{csrf_field()}}
    <input type="text" name="pseudoConnexion" placeholder="entrez votre nom" value="{{old('pseudoConnexion')}}">
    <input type="password" name="passwordConnexion" placeholder="entrez votre mot de passe" value="{{old('passwordConnexion')}}">
    <input class='btn validation' type="submit" name="" value="connexion">
  </form>

  <form class="mt-2 d-flex flex-column col-10 col-md-4 card" action="http://localhost:8888/siteBanqueLaravel/public/creationUser" method="post">
    {{csrf_field()}}
    <input type="text" name="pseudoCreation" placeholder="donnez un nom" value="{{old('pseudoCreation')}}">
    <input type="password" name="passwordCreation" placeholder="rentrez un mot de passe" value="{{old('passwordCreation')}}">
    <input type="text" name="mailCreation" placeholder="rentrez votre adresse mail" value="{{old('mailCreation')}}">
    <input class='btn validation' type="submit" name="" value="creer compte">
  </form>

</section>
@stop
