<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand active" href="#">Dailybell</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
            aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline mr-auto search-form">
                <input class="form-control" id="search-bar" type="text" placeholder="Search products"
                    aria-label="Search">
                <i class="fas fa-search text-white ml-3" aria-hidden="true"></i>
            </form>
            <div class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Login
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Signup
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </div>
        </div>
    </div>
</nav>
<!-- CSS  -->
<style>
.navbar {
    background-color: #2d5dd9;
}

.navbar-dark {
    box-shadow: none;
    margin-bottom: 0 !important;
}

.navbar-brand {
    font-weight: 700;
    font-size: 30px;
    color: white;
    text-decoration: none;
}

.nav-item:hover {
    background-color: #2d5dd9;
}

.fa-search {
    font-size: 20px;
    padding-left: 10px;
}

.search-form {
    padding-left: 100px;
    width: 70%;
}

#search-bar {
    width: 70%;
    font-size: 15px;
    padding: 20px 20px 20px 20px;
}

.nav-item {
    padding: 0px 15px 0px 15px;
    font-weight: 600;
    font-size: 15px;
}
</style>