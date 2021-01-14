<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostRequest;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;

/**
 * Class PostController
 * @package App\Http\Controllers\Blog\Admin
 */
class PostController extends BaseController
{

    /**
     * @var BlogPostRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $blogPostRepository;

    private $blogCategoryRepository;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();

        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $item = new BlogPost();

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit',
            compact('item', 'categoryList'));
    }

    /**
     * @param BlogPostCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->input();

        $item = (new BlogPost())->create($data);

        if ($item) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit',
            compact('item', 'categoryList'));
    }

    /**
     * @param BlogPostRequest $request
     * @param $id
     */
    public function update(BlogPostRequest $request, $id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        /**Перенесено в Обсервер*/
        /*if(empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }*/
        /**Перенесено в Обсервер*/
        /*if(empty($item->published_at) && $data['is_published']) {
            $data['published_at'] = Carbon::now();
        }*/

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = BlogPost::destroy($id);

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => 'Успешно удалено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка удаления'])
                ->withInput();
        }
    }
}
