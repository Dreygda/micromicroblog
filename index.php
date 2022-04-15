<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
    />
    <link
      rel="stylesheet"
      href="{{ url_for('static', filename='styles.css') }}"
    />
    <title>Micro-microblog</title>
  </head>
  <body>
    <h1 class="container s10">Micro-Microblog</h1>
    <div class="container s10">
      <form action="/" method="post" class="multipart/form">
        <div class="form-example">
          <label for="contenu">Entrez votre contenu: </label>
          <textarea name="contenu" id="contenu" required># </textarea>
        </div>
        <div class="form-example">
          <label for="password">Entrez votre secret: </label>
          <input type="password" name="password" id="password" />
        </div>
        <div class="form-example">
          <input type="submit" value="Envoyez!" />
        </div>
      </form>
    </div>
    <!-- <button id="tri">Tri</button> -->
    <div id="container" class="container s10"></div>
  </body>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/12.3.2/markdown-it.min.js"
    integrity="sha512-TIDbN32lXOg2Mw1VcnKrQLZgfALryJogWCu/NHWtlMCR1jget+mOwMtdehBBZz2f9PKeK2AQPwVxkbl4u/1H5g=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  ></script>
  <script>
    var json = "../DATA/posts.json";
    fetch(json)
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        data.forEach((file) => {
          fetch(file)
            .then((response) => response.json())
            .then((data) => {
            
              let container = document.getElementById("container");
              let divpost = document.createElement("div");
              divpost.className = "container";
              let diventete = document.createElement("div");
              diventete.className = "row";
              diventete.style.display = "flex";
              diventete.style.justifyContent = "space-between";
              divpost.appendChild(diventete);
              let date = document.createElement("div");
              let dateFormat = new Date(parseInt(data.date)).toDateString();
              date.innerHTML = "date:" + " " + dateFormat;
              date.className = "col s5";
              diventete.appendChild(date);
              let url = document.createElement("div");
              url.innerHTML = 'url:' + `<a href="http://127.0.0.1:5000/${data.url}">` + data.url
              url.className = "col s5";
              diventete.appendChild(url);
              var md = window.markdownit();
              var result = md.render(data.contenu);
              let contenu = document.createElement("div");
              contenu.innerHTML = "contenu:" + " " + result;
              contenu.className = "container";
              divpost.appendChild(contenu);
              container.appendChild(divpost);
              
            });
        });
      });
     
      // let bouton = document
      //           .getElementById("tri")
      //           .addEventListener("click", function () {

      //             data.sort((a, b) => b.data.date - a.data.date );
      //           });

                
  </script>
</html>
