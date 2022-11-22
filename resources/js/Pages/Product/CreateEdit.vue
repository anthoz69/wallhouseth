<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import { computed, ref } from 'vue'
import InputLabel from '@/Components/InputLabel.vue'
import { useForm } from '@inertiajs/inertia-vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import InputError from '@/Components/InputError.vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
    product: Object
})

const title = computed(() => {
    return props.product.name || 'เพิ่มสินค้า'
})

const mainImagePreview = ref(null);
const mainImageInput = ref(null);

const otherImagePreview = ref([]);
const otherImageInput = ref(null);

const form = useForm({
    sku: '',
    barcode: '',
    name: '',
    price: '0',
    attributes: '',
    main_image: '',
    other_image: [],
    width: '0',
    length: '0',
    height: '0',
    kg: '0',
    category_id: '0'
})

const selectNewPhoto = (type = 'main') => {
    if (type === 'main') {
        mainImageInput.value.click();
    } else {
        otherImageInput.value.click();
    }
};

const updatePhotoPreview = () => {
    const photo = mainImageInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        mainImagePreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const updateMultiplePhotoPreview = () => {
    const photo = otherImageInput.value.files;

    if (! photo.length) return;

    for (let i = 0; i < photo.length; i++) {
        const reader = new FileReader();

        reader.onload = (e) => {
            otherImagePreview.value.push(e.target.result)
        };

        reader.readAsDataURL(photo[i]);
    }
};

const clearPhotoFileInput = (type = 'main') => {
    if (type === 'main') {
        if (mainImageInput.value?.value) {
            mainImageInput.value.value = null;
        }
    } else {
        if (otherImageInput.value?.value) {
            otherImageInput.value.value = null;
        }
    }
};
</script>

<template>
    <AppLayout title="จัดการสินค้า">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ title }}
            </h2>
        </template>

        <div class="bg-white rounded-lg border border-gray-200 shadow-md">
            <div class="py-5 px-5">
                <form action="" class="flex flex-col gap-4">
                    <div class="form-control">
                        <InputLabel value="SKU" />
                        <TextInput v-model="form.sku" type="text" class="mt-1 block w-full"></TextInput>
                    </div>
                    <div class="form-control">
                        <InputLabel value="Barcode" />
                        <TextInput v-model="form.barcode" type="text" class="mt-1 block w-full"></TextInput>
                    </div>

                    <div class="form-control">
                        <InputLabel value="ชื่อสินค้า" />
                        <TextInput v-model="form.name" type="text" class="mt-1 block w-full"></TextInput>
                    </div>

                    <div class="form-control">
                        <InputLabel value="ราคา" />
                        <TextInput v-model="form.price" type="number" step="0.01" class="mt-1 block w-full"></TextInput>
                    </div>

                    <div class="form-control">
                        <InputLabel value="คุณสมบัติสินค้า ( คั่นด้วย , )" />
                        <TextInput v-model="form.attributes" type="text" class="mt-1 block w-full"></TextInput>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <!-- Profile Photo File Input -->
                        <input
                            ref="mainImageInput"
                            type="file"
                            class="hidden"
                            @change="updatePhotoPreview"
                        >

                        <InputLabel for="photo" value="รูปภาพหลัก" />

                        <!-- Current Profile Photo -->
                        <div v-show="! mainImagePreview && product.main_image" class="mt-2">
                            <img :src="product.main_image" :alt="product.name" class="object-cover">
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div v-show="mainImagePreview" class="mt-2">
                            <img :src="mainImagePreview" :alt="product.name" class="object-cover">
                        </div>

                        <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                            เลือกรูปภาพ
                        </SecondaryButton>

                        <InputError :message="form.errors.main_image" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <!-- Profile Photo File Input -->
                        <input
                            ref="otherImageInput"
                            type="file"
                            class="hidden"
                            @change="updateMultiplePhotoPreview"
                            multiple
                        >

                        <InputLabel value="รูปภาพเพิ่มเติม เลือกได้มากกว่า 1 ภาพ" />

                        <div v-if="otherImagePreview.length" class="mt-3">
                            <div class="flex gap-3">
                                <div class="col-span-6 sm:col-span-4" v-for="otip in otherImagePreview">
                                    <img :src="otip" class="object-cover">
                                </div>
                            </div>
                        </div>

                        <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                            เลือกรูปภาพ
                        </SecondaryButton>

                        <InputError :message="form.errors.other_image" class="mt-2" />
                    </div>

                    <div class="flex justify-end mt-4">
                        <primary-button>บันทึก</primary-button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
