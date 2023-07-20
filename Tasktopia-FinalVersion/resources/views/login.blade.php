<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link 
        rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
        
        <!-- Add SweetAlert CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

        <!-- Add SweetAlert JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>

        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <title>Tasktopia</title>
</head>

<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" class="form-control" name="email" required placeholder="Email">
                <input type="password" class="form-control" name="password" required placeholder="Password">
                <button name="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Tasktopia</h1>
                    <p><i>"United We Task!"<i><br>Boost team productivity with Tasktopia!  Stay focused on priority tasks & achieve more each day. Join us today & unlock the power of streamlined task management!</h2>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/main.js')}}"></script>
 </body>
</html>