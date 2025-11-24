<x-app-layout>
    <!-- TEMP : J'ai trouver ça ici ma poule:
      https://www.reddit.com/r/laravel/comments/9fs09l/help_laravel_302_post_error/
    -->
    <!-- Ca affiche les erreur si jamais il y a une redirection instant et qu'on les vois pas. -->
    @if (isset($errors) && count($errors))
     
        There were {{count($errors->all())}} Error(s)
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }} </li>
            @endforeach
        </ul>
                
    @endif
    <!-- TEMP :Pour le form il faut la method post, et la route tu la met en action -->
    <form method="POST" action="{{ route('survey.store') }}">
        <!-- TEMP: Ca c'est obligatoire, c'est pour verif si le form est pas expiré il me semble -->
        @csrf
        <div>
            <div>
                <label class="block mb-2.5 text-sm font-medium text-heading">Nom du sondage</label>
                <input
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    placeholder="JouiQuiz" required />
            </div>
            <div>

                <label for="message" class="block mb-2.5 text-sm font-medium text-heading">Your message</label>
                <textarea id="message" rows="4"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full p-3.5 shadow-xs placeholder:text-body"
                    placeholder="Write your thoughts here..."></textarea>

            </div>
            <div>
                <label class="block mb-2.5 text-sm font-medium text-heading">Voulez-vous être en Anonyme</label>
                <input type="checkbox" placeholder="Anonyme ?" />
            </div>
        </div>
        <button type="submit" class="text-white bg-blue-600 box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Confirmer votre sondage</button>
    </form>
</x-app-layout>