<x-layout>
<x-card>
    <header>
        <h1
            class="text-3xl text-center font-bold my-6 uppercase"
        >
            Manage Gigs
        </h1>
    </header>

    <table class="w-full table-auto rounded-sm">
        <tbody>
            @unless(empty($listings))
            @foreach($listings as $listing)
            <tr class="border-gray-300">
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a href="show.html">
                        {{$listing->title}}
                    </a>
                </td>
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a
                        href="/listings/{{$listing->id}}/edit"
                        class="text-blue-400 px-6 py-2 rounded-xl"
                        ><i
                            class="fa-solid fa-pen-to-square"
                        ></i>
                        Edit</a
                    >
                </td>
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                <form action='{{$listing->id}}' method='POST'>
                    @csrf
                    @method('delete')
                        <button class='text-red-500'>
                            <i class='fa-solid fa-trash'></i> Delete
                        </button>
                    
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr class="border-grey-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <p class="text-center">No listings</p>
                </td>
            </tr>
            @endunless
        </tbody>
    </table>
</x-card>
</x-layout>