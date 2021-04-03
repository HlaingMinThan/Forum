<div>
    <ais-hits>
        <div slot="item" slot-scope="{ item }">
            <a :href="item.path">
                <li v-text="item.title"></li>
            </a>
        </div>
    </ais-hits>
</div>