<div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f8f9fa;">
    @if (Route::has('login'))
        <div style="text-align: center;">
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    style="display: inline-block; padding: 10px 20px; margin: 10px; text-decoration: none; color: #000; background-color: #FF2D20; border-radius: 5px; transition: background-color 0.3s ease;"
                    onmouseover="this.style.backgroundColor='#e0241d'"
                    onmouseout="this.style.backgroundColor='#FF2D20'"
                    onfocus="this.style.outline='2px solid #FF2D20'"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    style="display: inline-block; padding: 10px 20px; margin: 10px; text-decoration: none; color: #000; background-color: #FF2D20; border-radius: 5px; transition: background-color 0.3s ease;"
                    onmouseover="this.style.backgroundColor='#e0241d'"
                    onmouseout="this.style.backgroundColor='#FF2D20'"
                    onfocus="this.style.outline='2px solid #FF2D20'"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        style="display: inline-block; padding: 10px 20px; margin: 10px; text-decoration: none; color: #000; background-color: #FF2D20; border-radius: 5px; transition: background-color 0.3s ease;"
                        onmouseover="this.style.backgroundColor='#e0241d'"
                        onmouseout="this.style.backgroundColor='#FF2D20'"
                        onfocus="this.style.outline='2px solid #FF2D20'"
                    >
                        Register
                    </a>
                @endif
            @endauth
        </div>
    @endif
</div>
