 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">LTKP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/" id="calculatorsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Calculation Tools
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/HLcalculator1">Heat Load Calculator 1</a>
              <a class="dropdown-item" href="/HLcalculator2">Heat Load Calculator 2</a>
              <a class="dropdown-item" href="/RiLcalculator">RiL Calculator</a>
              <a class="dropdown-item" href="/PEFcalculator">PEF Calculator</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/" id="DBDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Region Related Data
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/model">Create District Model</a>
              <a class="dropdown-item" href="/crud">Edit Models</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href={{route('data.index')}} method="get">Multicriteria Analysis</a>
            </div>
        </li>
        <li class="nav-item">
        <a class="nav-link contacts" href="/">About</a>
        </li>
</ul>
<form class="form-inline my-2 my-lg-0">
  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>
</div>
</nav>