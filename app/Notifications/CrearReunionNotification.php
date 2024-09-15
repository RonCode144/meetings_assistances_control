<?php

namespace App\Notifications;

use App\Models\ReuReunion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CrearReunionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reureunion;

    protected $reuasistentes;

    protected $asunto;

    /**
     * Create a new notification instance.
     */
    public function __construct(ReuReunion $reuReunion, $reuAsistentes = 0, $asunto = null)
    {
        $this->reureunion = $reuReunion;
        $this->reuasistentes = $reuAsistentes;
        $this->asunto = $asunto ?? 'Reunión Creada';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->asunto)
            ->line($this->reureunion->tema)
            ->view('qrcode', [
                'ruta' => route('asistencia', [
                    $this->reureunion->id_crypt,
                    $this->reuasistentes,
                ]),
            ]);
        // ->greeting('¡Querido Asistente!')
        // ->line('Al hacer clic en el siguiente botón, será dirigido al formulario de registro de asistencia de la reunión: ')
        // ->action('Formulario Registro de Asistencia', url(route('asistencia', $this->reureunion->id_crypt)))
        // ->line('¡Gracias por utilizar nuestros servicios!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
