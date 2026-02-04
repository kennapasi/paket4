public function store(Request $request) {
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'book_id' => 'required|exists:books,id',
        'tanggal_pinjam' => 'required|date',
    ]);

    $book = Book::findOrFail($request->book_id);

    if($book->stok > 0){
        $book->decrement('stok');

        Transaction::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'pinjam'
        ]);

        return redirect()->route('transactions.index')->with('success', 'Peminjaman berhasil dicatat.');
    } else {
        return back()->with('error', 'Stok buku habis!');
    }
}
