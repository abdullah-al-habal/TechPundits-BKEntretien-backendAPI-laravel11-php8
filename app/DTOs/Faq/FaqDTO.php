<?php

declare(strict_types=1);

namespace App\DTOs\Faq;

use App\Http\Requests\API\V1\Faq\CreateFaqRequest;

class FaqDTO
{
    public function __construct(
        public readonly string $question,
        public readonly string $answer,
        public readonly ?int $id = null,
    ) {}

    // public static function fromRequest(CreateFaqRequest|UpdateFaqRequest $request): self
    // {
    //     $validated = $request->validated();
    //     return new self(
    //         question: $validated['question'],
    //         answer: $validated['answer'],
    //         id: $request instanceof UpdateFaqRequest ? $validated['id'] : null
    //     );
    // }

    /**
     * @param array{question: string, answer: string, id?: int} $data
     */
    // public static function fromArray(array $data): self
    // {
    //     return new self(
    //         question: $data['question'],
    //         answer: $data['answer'],
    //         id: $data['id'] ?? null
    //     );
    // }

    /**
     * @return array{question: string, answer: string, id?: int}
     */
    // public function toArray(): array
    // {
    //     $array = [
    //         'question' => $this->question,
    //         'answer' => $this->answer,
    //     ];

    //     if ($this->id !== null) {
    //         $array['id'] = $this->id;
    //     }

    //     return $array;
    // }
}
