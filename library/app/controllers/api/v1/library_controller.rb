module Api
    module V1
        class LibraryController < ApplicationController
            def index
                books = Book.order('id ASC');
                render json: {status: 'SUCCESS', message:'Loaded Books', data:books},status: :ok
            end
            def show
                book = Book.find(params[:id])
                render json: {status: 'SUCCESS', message:'Loaded Book', data:book},status: :ok
            end
            def create
                book = Book.new(book_params)
                if book.save
                    render json: {status: 'SUCCESS', message:'Saved Books', data:book},status: :ok
                else
                    render json: {status: 'ERROR', message:'Book not Saved', data:books.errors},status: :unprocessable_entity
                end
            end
            def destroy
                book = Book.find(params[:id])
                book.destroy
                render json: {status: 'SUCCESS', message:'Deleted Book', data:book},status: :ok

            end
            def update
               book = Book.find(params[:id])
               if book.update(book_params)
                render json: {status: 'SUCCESS', message:'Updated Book', data:book},status: :ok
               else
                render json: {status: 'ERROR', message:'Book not Updated', data:Book.errors},status: :unprocessable_entity
               end
                
            end

            private

            def book_params
                params.permit(:title, :author, :publisher, :year)
            end
        end
    end
end