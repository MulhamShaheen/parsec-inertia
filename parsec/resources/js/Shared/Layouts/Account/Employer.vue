<template>
  <Header :auth="auth">

  </Header>
  <div class="m-8">
  <div class="container">
    <div class="grid gap-16 grid-cols-6">
      <div class="col-start-1 col-end-2">
        <SideBar>
          <template #upper>
            <li>
              <Link :href="route('account')" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700"
                    :class="{'text-gray-100 bg-indigo-600 hover:bg-indigo-600 hover:text-white': $page.component === 'Auth/Account/Employer'}">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                <span class="ml-3">Профиль</span>
              </Link>
            </li>
            <li>
              <Link :href="route('account.info')" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700"
                    :class="{'text-gray-100 bg-indigo-600 hover:bg-indigo-600 hover:text-white': $page.component === 'Auth/Account/Info/Employer'}">
                <span class="ml-3">Информация об организации</span>
              </Link>
            </li>
            <li>
              <Link :href="route('account.projects')" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700"
                    :class="{'text-gray-100 bg-indigo-600 hover:bg-indigo-600 hover:text-white': $page.component === 'Auth/Account/Projects/Employer'}">
                <span class="ml-3">Проекты</span>
              </Link>
            </li>
            <li>
              <Link :href="route('account.replies')" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700"
                    :class="{'text-gray-100 bg-indigo-600 hover:bg-indigo-600 hover:text-white': $page.component === 'Auth/Account/Replies/Employer'}">
                <span class="ml-3">Отклики</span>
              </Link>
            </li>
          </template>

          <template #lower>
            <li>
              <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white dark:text-gray-400" focusable="false" data-prefix="fas" data-icon="gem" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M378.7 32H133.3L256 182.7L378.7 32zM512 192l-107.4-141.3L289.6 192H512zM107.4 50.67L0 192h222.4L107.4 50.67zM244.3 474.9C247.3 478.2 251.6 480 256 480s8.653-1.828 11.67-5.062L510.6 224H1.365L244.3 474.9z"></path></svg>
                <span class="ml-4">Upgrade to Pro</span>
              </a>
            </li>
          </template>

        </SideBar>
      </div>
      <div class="col-start-2 col-end-7">
        <slot>

        </slot>
      </div>
    </div>
  </div>
  </div>
</template>

<script>

import Header from "../../Header";

export default {

  name: "Employer",
  components:{
    Header
  },
  props:{
    auth:Object,
  }
}
</script>

<style scoped>

</style>