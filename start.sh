#!/bin/bash

echo "🐳 Démarrage de Docker..."
docker-compose up -d

if [ $? -eq 0 ]; then
    echo "✅ Docker tourne."
    
    PROJECT_DIR=$(wslpath -w $(pwd))

    echo "🚀 Ouverture des onglets pour Queue et Schedule..."

    wt.exe -w 0 nt -p "Ubuntu" -d "$PROJECT_DIR" --title "Laravel Queue" bash -c "docker-compose exec app npm run dev; exec bash"

    wt.exe -w 0 nt -p "Ubuntu" -d "$PROJECT_DIR" --title "Laravel Queue" bash -c "docker-compose exec app php artisan queue:work; exec bash"
    
    wt.exe -w 0 nt -p "Ubuntu" -d "$PROJECT_DIR" --title "Laravel Schedule" bash -c "docker-compose exec app php artisan schedule:work; exec bash"

else
    echo "❌ Erreur Docker."
fi