<head>
    <link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
</head>
<body ng-app="cnerr">
    <div class="well" style="width: 700px; margin: 0 auto;">
        <form method="post" ng-controller="RegisterController">
            <div class="form-group<?= "{{ hasUsernameError ? ' has-error' : '' }}" ?>">
                <label class="sr-only">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username" ng-model="usernameModel">
                <p class="help-block"><?="{{  username }}"?></p>
            </div>
            <div class="form-group<?= "{{ hasEmailError ? ' has-error' : '' }}" ?>">
                <input type="email" class="form-control" name="email" placeholder="Email" ng-model="emailModel">
                <p class="help-block"><?='{{  email }}'?></p>
            </div>
            <div class="form-group<?= "{{ hasPasswordError ? ' has-error' : '' }}" ?>">
                <input type="password" class="form-control" name="password" placeholder="Password" ng-model="passwordModel">
                <p class="help-block"><?='{{  password }}'?></p>
            </div>
            <button type="button" ng-click="register()" class="btn btn-default">REGISTER</button>
        </form>
    </div>
    <script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.js">-</script>
    <script type="text/javascript" src="node_modules/angular/angular.js"></script>
    <script type="text/javascript" src="script/app.js"></script>
</body>