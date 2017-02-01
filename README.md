# my_mvc
This is a practice from https://github.com/PatrickLouys/no-framework-tutorial

1. composer.json 設定 namespace App 指到 src 資料夾
2. public 資料夾內只有 index.php 和其他可以公開的資源，index.php 載入真正的核心 Bootstrap.php
3. Bootstrap.php 載入 composer 的 autoload.php，以存取所有套件
4. 使用 [filp/whoops](https://github.com/filp/whoops) 來做 error handler，提供較豐富的訊息
5. 雖然 PHP 本身已經有許多 super global 變數可以存取 http request，但若想要讓程式更乾淨好維護符合 SOLID，那應該要有一個專門的 class 負責處理 request & response，目前使用 [HTTP component](https://github.com/PatrickLouys/http)
6. 在 Bootstrap.php 中 new Request 和 Response，並使用 Response 做輸出
7. 使用 [FastRoute](https://github.com/nikic/FastRoute) 來定義 URI 的行為，將設定都放在 Routes.php 內，若 URI 找不到 Route 對應，則用 $response 做對應的輸出
8. Routes.php 定義每個動作對應的 Controller class 和 method，Bootstrap.php 若找到了對應的 route，則 new 該 class，並執行指定的 method
9. 使用 Dependency Injection 做 Inversion of Control，每個 Controller 只需要去 *ask* 他需要的 object，而不自己 new
10. 使用 [Auryn](https://github.com/rdlowrey/Auryn) 做 Dependency Injectior，$injector->share() 可以使用同個物件，$injector->alias() 可以使用 interface 做 Type Hint，若是物件建立時需要參數則可用 $injector->define() 來額外指定每個參數應傳入什麼值
11. Bootstrap.php 載入 Denpendency.php，Response 和 Request 物件不使用 new，改用 $injector->make() 來產生，route 對應後要產生的 class 也是用 make() 建立，如此把 Controller 的依賴都記錄在 Denpendency.php 裡面了，__construct() 需要的物件只要指定好 Type Hint 都會自動傳入
12. Template Engine 選用 [Twig](http://twig.sensiolabs.org/)，但程式不要依賴 Twig，所以中間都透過 interface 做隔離 (依賴抽象，而不依賴具象)
13. 建立 Renderer interface，有一個 render() method，Twig 或是要切換別的 template 都要繼承此 interface，在 Dependency.php 中定義好要用的 template 關係
14. Controller 中原本使用 echo 輸出的地方都改為用 renderer 和 response 處理
15. 將重複使用到的頁面獨立為 Layout.php 並在其他頁面載入此區塊，其中共用需要呈現的資料的邏輯，例如 Menu，一樣透過 interface 再去實作
