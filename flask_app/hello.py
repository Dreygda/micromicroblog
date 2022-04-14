import json
from datetime import datetime
from flask import Flask, render_template, request
from hashlib import sha512

app = Flask(__name__,
            static_url_path='/DATA', 
            static_folder='DATA')

@app.route('/', methods=['GET'])
def micro_micro():
    return render_template('template.html')

def data(): 

    now=datetime.now()
    date_time = now.strftime("%m%d%Y%H%M%S")

    file= 'DATA/'+date_time+'.json'
    with open(file,'w') as outfile:
        donnee={
        "url":file,
        "contenu":request.form['contenu'],
        "date":date_time
        }
        json.dump(donnee,outfile)

    with open('./DATA/posts.json','r') as f:
        results = json.load(f)
        results.append('http://127.0.0.1:5000/' + file)
    with open('./DATA/posts.json', 'w') as f:
        json.dump(results, f, indent=4)
    return 'http://127.0.0.1:5000/' + file

@app.route('/', methods=['POST'])
def checkpass():
    with open('token.txt') as test_f:
        pwd_fichier=test_f.readline()
        a=request.form['password']
        a= a.encode()
            
    retour = sha512(a).hexdigest()

    if retour == pwd_fichier:
        return data()
    return 'error 403'



if __name__ == "main":
    app.run(debug=True)



