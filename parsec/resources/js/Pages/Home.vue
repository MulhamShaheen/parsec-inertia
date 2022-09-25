<template>
  <Head>
    <title>{{ $page.props.title }} - My awesome app</title>
  </Head>

  <div class="p-6">
    <div class="flex space-x-4 mb-4">
      <Link
          :href="route('homepage')"
          class="text-gray-700 bg-gray-200 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
      >Homepage
      </Link>
      <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              type="button" data-modal-toggle="modal">
        Toggle modal
      </button>
    </div>
    <MyModal :modalId="'modal'" :modal-text="'adakdm test tefjksnd fklsdf sdnf ljsndf'" :modal-title="'Test'">

    </MyModal>

    <h1>This is: {{ $page.props.title }}</h1>


  </div>
</template>
<script>
import MyModal from "../Shared/Components/MyModal";
export default{
  components: {MyModal}
}
</script>