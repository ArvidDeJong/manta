<?php

namespace Darvis\Manta\Livewire\Page;

use Darvis\Manta\Models\Page;
use Darvis\Manta\Traits\MantaTrait;
use Illuminate\Http\Request;
use Livewire\Component;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PageCreate extends Component
{
    use MantaTrait;
    use PageTrait;

    public function mount(Request $request)
    {
        $this->locale = getLocaleManta();
        if ($request->input('locale') && $request->input('pid')) {
            $page = Page::find($request->input('pid'));
            $this->pid = $page->id;
            $this->locale = $request->input('locale');
            $this->itemOrg = $page;
        }

        if (class_exists(Faker::class) && config('app.env') === 'local') {
            $faker = Faker::create('nl_NL');  // Nederlandse locale voor realistische gegevens

            // Velden met gegenereerde fake data
            // $this->title = $faker->sentence(4);  // Een willekeurige zin van 4 woorden als titel
            // $this->title_2 = $faker->sentence(4);  // Een willekeurige zin van 4 woorden als subtitel
            // $this->title_3 = $faker->sentence(4);  // Een willekeurige zin van 4 woorden als subtitel
            // $this->title_4 = $faker->sentence(4);  // Een willekeurige zin van 4 woorden als subtitel
            // $this->slug = Str::slug($this->title);  // Een slug gegenereerd op basis van de title
            // $this->seo_title = $this->title;  // De SEO-titel is hetzelfde als de title
            // $this->seo_description = $faker->text(160);  // SEO-beschrijving met maximaal 160 karakters
            // $this->tags = implode(', ', $faker->words(5));  // Een string met 5 willekeurige woorden als tags
            // $this->excerpt = $faker->text(500);  // Uittreksel van 500 karakters
            // $this->content = $faker->paragraphs(5, true);  // 5 willekeurige paragrafen als content
            // $this->homepage = $faker->boolean;  // Willekeurig true of false voor homepage
            // $this->locked = $faker->boolean;  // Willekeurig true of false voor locked
            // $this->fullpage = $faker->boolean;  // Willekeurig true of false voor fullpage
        }
        //
        $this->getLocaleInfo();
        $this->tablistShow = $this->locale;
        $this->getTablist();
        $this->getBreadcrumb('create');
    }

    public function render()
    {
        return view('manta::default.manta-default-create')->title($this->config['module_name']['single'] . ' toevoegen');
    }

    public function save()
    {
        $this->validate();

        $row = $this->only(
            'company_id',
            'pid',
            'locale',
            'description',
            'title',
            'title_2',
            'title_3',
            'title_4',
            'slug',
            'seo_title',
            'seo_description',
            'excerpt',
            'content',
            'template',
            'homepage',
            'homepageSort',
            'locked',
            'fullpage',
            'link',
            'tags',
            'route',
            'route_title',
            'option_1',
            'option_2',
            'option_3',
            'option_4',
        );
        $row['created_by'] = auth('staff')->user()->name;
        $row['host'] = request()->host();
        $row['slug'] = $this->slug ? $this->slug : Str::of($this->title)->slug('-');
        $page = Page::create($row);

        return $this->redirect(route('page.read', ['page' => $page]));
    }
}
