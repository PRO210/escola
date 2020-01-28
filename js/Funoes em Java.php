
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!--Link para voltar pagina-->
        <a href="javascript:history.back()" class="btn btn-primary btn-block">Voltar</a>
        <input type="button" value="Voltar Para a Página Anterior" class="btn btn-primary btn-block botoes" onClick=" window.history.back()">            
        //
        <script>
            https://pt.stackoverflow.com/questions/101838/base64-encode-em-javascript
                    var data = window.prompt("Digite a sua string:");

            if (data) {
                var b64 = window.btoa(data);
                alert("Codificado: " + b64);
                alert("Decodificado: " + window.atob(b64));
            } else {
                alert("Nada foi digitado");
            }
        </script>
        <!--        //-->
        <input type="text" id="input" />
        <button id="encode">Encode</button>
        <button id="decode">Decode</button>
        <p id="output"></p>
        <br>
        <a href="https://github.com/carlo/jquery-base64" target="_blank">On Github</a>
        <script>
            https://jsfiddle.net/onigetoc/g0y8qr9a/
                    $("#encode").click(function () {
                var getval = $("#input").val();
                var result = $.base64.encode(getval)
                $("p").text(result);
            });

            $("#decode").click(function () {
                var getval = $("#input").val();
                var result = $.base64.decode(getval)
                $("p").text(result);
            });

        </script>




















    </body>
</html>
