@extends('master')
@section('content')
<article class="">
  @if(session('error'))
    <p class='text-center'>{{session('error')}}</p>
    <?php Session::forget('error');  ?>
  @endif
</article>
<section class='d-flex flex-nowrap justify-content-around align-items-center'>
  <form class="d-flex flex-column col-4" action="http://localhost:8888/siteBanqueLaravel/public/testConnexion" method="post">
    {{csrf_field()}}
    {!!$errors->first('pseudoConnexion', '<p class="error-msg text-center">
        :message
      </p>')!!}
    {!!$errors->first('passwordConnexion', '<p class="error-msg text-center">
        :message
      </p>')!!}
    <input type="text" name="pseudoConnexion" placeholder="entrez votre nom" value="{{old('pseudoConnexion')}}">
    <input type="password" name="passwordConnexion" placeholder="entrez votre mot de passe" value="{{old('passwordConnexion')}}">
    <input type="submit" name="" value="connexion">
  </form>
  <form class="mt-2 d-flex flex-column col-4" action="http://localhost:8888/siteBanqueLaravel/public/creationUser" method="post">
    {{csrf_field()}}
    {!!$errors->first('pseudoCreation', '<p class="error-msg text-center">
        :message
      </p>')!!}
    {!!$errors->first('passwordCreation', '<p class="error-msg text-center">
        :message
      </p>')!!}
    {!!$errors->first('mailCreation', '<p class="error-msg text-center">
          :message
        </p>')!!}
    <input type="text" name="pseudoCreation" placeholder="donnez un nom" value="{{old('pseudoCreation')}}">
    <input type="password" name="passwordCreation" placeholder="rentrez un mot de passe" value="{{old('passwordCreation')}}">
    <input type="text" name="mailCreation" placeholder="rentrez votre adresse mail" value="{{old('mailCreation')}}">
    <input type="submit" name="" value="creer compte">
  </form>
</section>
@stop
