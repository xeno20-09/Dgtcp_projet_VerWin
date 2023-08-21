<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Input Fields</title>
</head>

<body>
    <div id="inputContainer">
        <!-- Les champs d'entrée seront ajoutés ici -->
    </div>
    <button id="addInput">Ajouter un champ d'entrée</button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputContainer = document.getElementById('inputContainer');
            const addInputButton = document.getElementById('addInput');
            let inputCount = {{ $numberinput }};

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'dynamic_input' + inputCount;
            input.placeholder = 'Champ d\'entrée dynamique ' + inputCount;

            inputContainer.appendChild(input);
        });
    </script>
</body>

</html>
