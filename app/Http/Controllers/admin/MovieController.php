<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie; // Nhớ gọi cái Model Movie (cái nãy ông khai báo $fillable á) vào nha!
use App\Models\Category;
use App\Models\Country;

class MovieController extends Controller
{
    // Hàm này chuyên trị trang Danh sách phim
    public function index()
    {
        // Lấy phim từ Database, sắp xếp mới nhất lên đầu, cắt ra 10 bộ mỗi trang
        $movies = Movie::orderBy('created_at', 'desc')->paginate(10);

        // Quăng dữ liệu sang cái view movie.blade.php nằm trong thư mục admin
        return view('admin.movie', compact('movies')); 
        // (Chỗ này tuỳ ông lưu file view ở đâu nha, nếu lưu ở resources/views/admin/movie.blade.php thì đổi thành 'admin.movie')
    }
    public function create()
    {
        $categories = Category::all();
        $countries = Country::all(); 

        return view('admin.create', compact('categories', 'countries'));
    }
    public function store(Request $request)
    {
        // 1. Tạo một cái khuôn (Object) phim mới
        $movie = new Movie();
        
        // 2. Hứng data từ Form (nhập chữ/chọn select) đắp vào khuôn
        $movie->title = $request->title;
        $movie->slug = $request->slug;
        $movie->description = $request->description;
        $movie->year = $request->year;
        $movie->resolution = $request->resolution;
        $movie->subtitle_type = $request->subtitle_type;
        $movie->status = $request->status;
        $movie->category_id = $request->category_id;
        $movie->country_id = $request->country_id;
        
        // Riêng thằng Checkbox (Trending), nếu có tích thì là 1, không tích thì là 0
        $movie->is_trending = $request->is_trending ? 1 : 0; 
        
        // Mặc định cho mấy cái này bằng 0 hoặc 1 nếu DB bắt buộc (sếp tự chỉnh theo DB nha)
        $movie->is_top_rated = 0; 
        $movie->is_upcoming = 0;

        // 3. XỬ LÝ UPLOAD ẢNH BÌA (Tuyệt kỹ nằm ở đây)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            
            // Lấy cái đuôi file (ví dụ: jpg, png...)
            $extension = $file->getClientOriginalExtension(); 
            
            // Đặt tên file mới = thời gian hiện tại + đuôi (Để 100% không bị trùng tên file)
            $filename = time() . '.' . $extension; 
            
            // Di chuyển file ảnh đó vào thư mục public/uploads/movies/
            $file->move(public_path('images/movies/'), $filename); 
            
            // Lưu đường dẫn vào Database để mốt lấy ra xài
            $movie->image = 'images/movies/' . $filename; 
        } else {
            // Nếu sếp lười không úp ảnh thì gán cho nó cái ảnh mặc định
            $movie->image = 'images/movies/default.jpg'; 
        }

        // 4. BẤM NÚT LƯU VÀO DATABASE
        $movie->save();

        // 5. Quay xe về lại trang Danh sách phim và mang theo câu thông báo "Thành công"
        return redirect()->route('admin.movie.index')->with('success', 'Sếp đã thêm phim mới thành công!');
    }


    //Mở trang sửa
    public function edit($id)
    {
        // Tìm phim theo ID
        $movie = Movie::find($id);
        if (!$movie) {
            return redirect()->route('admin.movie.index')->with('error', 'Không tìm thấy phim này!');
        }
        $categories = Category::all();
        return view('admin.edit', compact('movie', 'categories'));
    }

    //Gửi và lưu tt mới
    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        
        // Cập nhật text y chang lúc thêm mới
        $movie->title = $request->title;
        $movie->slug = $request->slug;
        $movie->description = $request->description;
        $movie->year = $request->year;
        $movie->resolution = $request->resolution;
        $movie->status = $request->status;
        $movie->category_id = $request->category_id;
        
        $movie->is_trending = $request->has('is_trending') ? 1 : 0;
        $movie->is_top_rated = $request->has('is_top_rated') ? 1 : 0;
        $movie->is_upcoming = $request->has('is_upcoming') ? 1 : 0;
        // Xử lý nếu người dùng chọn upload ảnh mới
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/movies/'), $filename);
            
            // Nếu có ảnh cũ (và không phải ảnh mặc định) thì xóa file ảnh cũ cho nhẹ máy
            if(file_exists(public_path($movie->image)) && $movie->image != 'uploads/movies/default.jpg'){
                unlink(public_path($movie->image));
            }

            // Gán đường dẫn ảnh mới
            $movie->image = 'uploads/movies/' . $filename;
        }

        $movie->save();

        return redirect()->route('admin.movie.index')->with('success', 'Sửa phim thành công!');
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);

        if($movie) {
            // Chỉ cần gõ delete(), Laravel sẽ tự hiểu đây là Xóa Mềm.
            // TUYỆT ĐỐI KHÔNG XÓA FILE ẢNH ở bước này nha sếp, để mốt còn hồi sinh!
            $movie->delete();

            return redirect()->back()->with('success', 'Đã tống phim vào thùng rác an toàn!');
        }

        return redirect()->back()->with('error', 'Không tìm thấy phim để xóa!');
    }

    
}