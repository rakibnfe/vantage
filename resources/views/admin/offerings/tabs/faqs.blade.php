@props(['offering' => null])

@php
    $faqsData = old('faqs');
    if (empty($faqsData) && $offering && $offering->faqs) {
        $faqsData = $offering->faqs->toArray();
    }
    if (empty($faqsData)) {
        $faqsData = [];
    }
@endphp

<div x-data="faqsManager({{ json_encode($faqsData) }})">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Frequently Asked Questions</h3>
        <button type="button" 
                @click="addFaq"
                class="inline-flex items-center px-3 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg">
            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
            Add FAQ
        </button>
    </div>
    
    <div class="space-y-4">
        <template x-for="(faq, index) in faqs" :key="index">
            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg relative">
                <button type="button" 
                        @click="removeFaq(index)"
                        class="absolute top-2 right-2 text-gray-400 hover:text-red-500 dark:hover:text-red-400">
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                </button>
                
                <div class="space-y-4">
                    <div>
                        <label :for="'faqs_'+index+'_question'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Question
                        </label>
                        <input type="text" 
                               :name="'faqs['+index+'][question]'"
                               x-model="faq.question"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"
                               required>
                    </div>
                    
                    <div>
                        <label :for="'faqs_'+index+'_answer'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Answer
                        </label>
                        <textarea :name="'faqs['+index+'][answer]'"
                                  x-model="faq.answer"
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"
                                  required></textarea>
                    </div>
                    
                    <input type="hidden" :name="'faqs['+index+'][order]'" x-model="faq.order">
                </div>
            </div>
        </template>
        
        <div x-show="faqs.length === 0" class="text-center py-12">
            <x-heroicon-o-question-mark-circle class="w-12 h-12 mx-auto text-gray-400" />
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No FAQs added yet. Click "Add FAQ" to start.</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
function faqsManager(initialFaqs = []) {
    return {
        faqs: initialFaqs.length ? initialFaqs.map((f, index) => ({ ...f, order: index })) : [],
        addFaq() {
            this.faqs.push({
                question: '',
                answer: '',
                order: this.faqs.length
            });
        },
        removeFaq(index) {
            this.faqs.splice(index, 1);
            this.faqs.forEach((faq, i) => faq.order = i);
        }
    }
}
</script>
@endpush