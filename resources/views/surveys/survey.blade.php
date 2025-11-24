<x-app-layout>
    <form>
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
        <button type="submit" onclick="{{ url("/survey/create") }}" class="text-white bg-blue-600 box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Confirmer votre sondage</button>
    </form>
</x-app-layout>