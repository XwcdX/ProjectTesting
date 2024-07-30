@extends('admin.layout')

@section('style')
    <style>
        @keyframes typing {
            from {
                width: 0;
            }

            to {
                width: var(--typing-width);
            }
        }

        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }

        .typing-effect {
            font-size: 80px;
            white-space: nowrap;
            overflow: hidden;
            border-right: .15em solid;
            width: 0;
            --typing-width: 100%;
            /* Fallback width */
        }
    </style>
@endsection

@section('content')
    <div style="width:100%; height:100vh; display: flex; justify-content:center; align-items:center">
        <h1 id="welcome-text" class="typing-effect"></h1>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var adminName = "{{ $admin->name }}";
            var text = "Welcome, " + adminName;
            var typingEffectElement = document.getElementById('welcome-text');

            function typeEffect() {
                typingEffectElement.style.width = '0';
                typingEffectElement.textContent = text;
                typingEffectElement.style.animation = 'none'; // Reset animation

                setTimeout(function() {
                    typingEffectElement.style.width = 'auto';
                    var steps = text.length;

                    // Create a temporary element to measure text width
                    var tempElement = document.createElement('span');
                    tempElement.style.fontSize = '80px';
                    tempElement.style.whiteSpace = 'nowrap';
                    tempElement.style.visibility = 'hidden';
                    tempElement.textContent = text;
                    document.body.appendChild(tempElement);
                    var textWidth = tempElement.offsetWidth;
                    document.body.removeChild(tempElement);

                    // Set CSS variable for typing width
                    typingEffectElement.style.setProperty('--typing-width', `${textWidth + 100}px`);

                    typingEffectElement.style.animation =
                        `typing 3.5s steps(${steps * 2}, end) forwards, blink .75s step-end infinite`;
                }, 50);
            }

            typeEffect();
            setInterval(typeEffect, 3500); // Repeat every 3.5 seconds
        });
    </script>
@endsection