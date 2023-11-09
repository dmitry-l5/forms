<x-layouts.app>
    @php( $form_items = json_decode($form->data_json)->items)
 
    <x-forms.viewer_1 :items="$result">
        
    </x-forms.viewer_1>
    {{-- {{ dd($result, $form_items) }} --}}
</x-layouts.app>