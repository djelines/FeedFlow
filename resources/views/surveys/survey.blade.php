<x-app-layout>

    <!-- Ca affiche les erreur si jamais il y a une redirection instant et qu'on les vois pas. -->
    @if (isset($errors) && count($errors))
     
        There were {{count($errors->all())}} Error(s)
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }} </li>
            @endforeach
        </ul>
    @endif
    <form method="POST" action="{{ route('survey.store') }}">
        @csrf

        {{-- Usefull : 'Old' method ! https://laravel.com/docs/5.7/helpers#method-old --}}
        <div>
            <div>
                <label class="block mb-2.5 text-sm font-medium text-heading">Titre du sondage</label>
                <input
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Titre de votre sondage !" 
                    required />
            </div>
            <div>

                <label for="message" class="block mb-2.5 text-sm font-medium text-heading">Description</label>
                <textarea id="message" rows="4"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full p-3.5 shadow-xs placeholder:text-body"
                    placeholder="Write your thoughts here..."
                    name="description"
                    required>{{ old('description') }}</textarea>

            </div>
            <div>
                <label class="block mb-2.5 text-sm font-medium text-heading">Voulez-vous être en Anonyme</label>
                <input type="hidden" name="is_anonymous" value="0">{{--  WTF ? on est obligé ?  --}}
                <input type="checkbox" 
                    placeholder="Anonyme ?" 
                    name="is_anonymous"
                    value="1"
                    {{old('is_anonymous') ? 'checked' : ''}}
                    />
            </div>
            <div>
                <label for="meeting-time">Date de début</label>

                <input
                    type="datetime-local"
                    name="start_date"
                    value="{{ Carbon\Carbon::now() }}"
                    min="{{ Carbon\Carbon::now() }}"
                    max="{{ Carbon\Carbon::now()->addYears(1) }}" />
            </div>
            <div>
                <label for="meeting-time">Date de fin</label>

                <input
                    type="datetime-local"
                    name="end_date"
                    value="{{ Carbon\Carbon::now()->addDay() }}"
                    min="{{ Carbon\Carbon::now() }}"
                    max="{{ Carbon\Carbon::now()->addYears(1) }}" />
            </div>
            {{-- WARNING !! This is temp, remove that when we have the Organization who working well --}}
            <input type="hidden" name="organization_id" value="1">

        </div>
        <button type="submit" class="text-white bg-blue-600 box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Confirmer votre sondage</button>
    </form>
</x-app-layout>