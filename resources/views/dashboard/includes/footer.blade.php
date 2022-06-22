
@if(Session::has('success'))
    <div class="row mr-2 ml-2">
        <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"
                id="type-error">{{Session::get('success')}}
        </button>
    </div>
@endif
<footer class="footer footer-static footer-light navbar-border navbar-shadow " >
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">
          Copyright &copy; {{date('Y')}}
          <a class="text-bold-800 grey darken-2" href="" target="_blank">
              keroles nabil
          </a>,
          All rights reserved. </span>
        <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block"> done
            <i class="ft-heart pink">

            </i>
        </span>
    </p>
</footer>
