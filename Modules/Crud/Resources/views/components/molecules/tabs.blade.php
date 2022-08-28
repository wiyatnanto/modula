@props(['active'])
<div x-data="{
    activeTab: $persist('{{ $active }}'),
    tabs: [],
    tabHeadings: [],
}" x-init="() => {
    tabs = [...$refs.tabs.children];
    tabHeadings = tabs.map(tab => {
        return { name: $(tab).attr('data-name'), title: $(tab).attr('data-title') }
    });
    if (!tabHeadings.some(e => e.name === activeTab)) {
        activeTab = '{{ $active }}'
    }
}">
    <ul class="nav nav-tabs nav-tabs-line" role="tablist" x-show="tabs.length > 0">
        <template x-for="(tab, index) in tabHeadings" :key="index">
            <li class="nav-item">
                <a class="nav-link" :class="tab.name === activeTab ? 'active' : ''" x-text="tab.title"
                    @click="()=> {
                      activeTab = tab.name
                    }" />
            </li>
        </template>
    </ul>
    <div class="tab-content" x-ref="tabs">
        {{ $slot }}
    </div>
</div>
