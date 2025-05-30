<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
</head>
<body>
    <h1>404</h1>
    <h2>Page Not Found</h2>
    <button class="boton" onclick="window.location.href='/'">BACK TO HOME</button>
    <style>
        body {
            background-color: #000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
            font-family: monospace;
            color: #fff;
        }
        h1 {
            font-size: 80px;
            margin: 10px 0;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }
        h2 {
            font-size: 40px;
            margin: 10px 0;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.6);
        }
        .boton {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
            background: linear-gradient(45deg, #8a2be2, #00ff00); 
            border: 3px solid #00ff00; 
            padding: 15px 40px;
            border-radius: 12px;
            cursor: pointer;
            box-shadow: 0 0 15px #00ff00, 0 0 30px #8a2be2; 
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: pulse 2s infinite; 
            margin-top: 20px;
        }
        .boton:hover {
            transform: scale(1.1); 
            box-shadow: 0 0 25px #00ff00, 0 0 50px #8a2be2; 
            background: linear-gradient(45deg, #00ff00, #8a2be2); 
        }
        .boton:active {
            transform: scale(0.95); 
        }
    </style>
</body>
</html>